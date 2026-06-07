<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Waarheen redirecten als de gebruiker niet is ingelogd.
     */
    protected function redirectTo($request): ?string
    {
        //als het een API-call is geen redirect maar een 401 response
        if($request->expectsJson()){
            return null;
        }

        //anders: stuur naar de inlog pagina
        return route('login');


    }

}