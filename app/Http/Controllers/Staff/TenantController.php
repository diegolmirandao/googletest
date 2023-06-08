<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stancl\Tenancy\Database\Models\Domain;

class TenantController extends Controller
{
    /**
     * Identify tenant by domain name
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function identifyDomain(Request $request)
    {
        if ($request->domain) {
            $domain = Domain::where('domain', $request->domain)->first();
    
            if ($domain) {
                return $domain;
            } else {
                abort(404, 'No se pudo identificar tenant');
            }
        } else {
            abort(400);
        }
    }
}
