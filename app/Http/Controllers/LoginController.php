<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User\User;

class LoginController extends Controller
{
    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'username';
    }

    public function login(Request $request) {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = null;
        $userExist = User::where('username', $request->username)->orWhere('email', $request->username)->first();

        if ($userExist) {
            $credentials = $request->only('username', 'password');
            $successfulLogin = false;

            $firstAttemp = Auth::attempt($credentials, true);
            
            if ($firstAttemp) {
                $successfulLogin = $firstAttemp;
            } else {
                $successfulLogin = Auth::attempt(['email' => $request->username, ...$request->only('password')], true);
            }

            if (!$successfulLogin) {
                return response()->json([
                    'success' => 'error', 
                    'message' => __('auth.invalid_password')], 
                401);
            }

            $request->session()->regenerate();
                
            $user = auth()->user();
            
            return $user;
        } else {
            return response()->json([
                'success' => 'error', 
                'message' => __('auth.user_not_exist')], 
            404);
        }

        return $user;
    }

    public function logout(Request $request) {
        $currentUser = Auth::user();

        // se desconecta al usuario del device
        $device = $currentUser->device();
        $device->disconnect();
        $device->setConnected(null);
        $device->setLastConnected($currentUser->id);
        $device->setLastConnection();
        $device->save();
        
        Auth::guard('web')->logout();

        $request->session()->invalidate();
 
        $request->session()->regenerateToken();
  
        return response()->json([
            'success' => 'success', 
            'message' => ''], 
        200);
    }
}
