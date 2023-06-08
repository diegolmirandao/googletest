<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User\User;
use App\Models\Device;
use Jenssegers\Agent\Facades\Agent;

class UserDevice
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (auth()->check()) {
            $device = null;
            $user = auth()->user();

            if ($request->hasCookie('Device-Id')) {
                // si el usuario ya tiene un device asociado
                $deviceCookieId = $request->cookie('Device-Id');
                $device = Device::find($deviceCookieId);
                
                // se comprueba que el device exista
                if (!$device) {
                    abort(403);
                }
            } else {
                // si no tiene un device asociado se genera uno nuevo
                $device = Device::create(['name' => Agent::device() ? Agent::platform().' - '.Agent::browser() : $request->userAgent()]);
                $response->withCookie(cookie()->forever('Device-Id', $device->id));
            }
    
            // se pone el device en estado online
            $device->connect();
            $device->setConnected($user->id);
            $device->save();

            $response->setContent(json_encode([
                'user' => $user,
                'deviceId' => $device->id
            ]));
        }

        return $response;
    }
}
