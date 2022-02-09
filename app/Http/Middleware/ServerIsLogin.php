<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;

class ServerIsLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Session::has('devCoreLogin') && Session::get('devCoreLogin')) {
            $response = $next($request);
            return $response->header('Cache-Control','nocache, no-store, max-age=0, must-revalidate')
            ->header('Pragma','no-cache')
            ->header('Expires','Fri, 01 Jan 1990 00:00:00 GMT');
        }
        return redirect()->route('dev.login')
            ->with('msg_title', 'Oops!')
            ->with('msg','!!! UnAuthorized Access !!!')
            ->with('msg_class', 'alert alert-danger');
        
    }
}
