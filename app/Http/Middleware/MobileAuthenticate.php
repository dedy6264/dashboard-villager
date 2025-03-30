<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\MobileAuthenticate as Middleware;

class MobileAuthenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not Mobileauthenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            // $mainData=[
            //     'endpoint'=>"",
            // ];
            // return view('mobile.layouts.loading',compact('mainData'));
            return route('mobile.login');
        }
    }
}
