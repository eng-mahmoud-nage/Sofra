<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        $middle = $request->route()->middleware()[1];
        if (! $request->expectsJson() && $middle =="auth:client-web") {
            return url('/client-login');
        }elseif(! $request->expectsJson() && $middle =="auth:restraunt-web"){
            return route('/restraunt-login');
        }elseif(! $request->expectsJson() && $middle =="auth:web"){
            return route('login');
        }elseif($request->expectsJson()){
            return ResponseJson(0, 'unauthenticated...');
        }
    }
}
