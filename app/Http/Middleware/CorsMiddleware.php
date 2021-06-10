<?php

namespace App\Http\Middleware;

use Closure;

class CorsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle( $request, Closure $next )
    {
        $headers = [
            'Access-Control-Allow-Origin'      => '*', //[ 'http://localhost:8080', 'https://devposnmolina.facturele.com/' ],
            'Access-Control-Allow-Methods'     => '*', //'POST, GET, OPTIONS, PATCH, PUT, DELETE',
            'Access-Control-Allow-Credentials' => 'true',
            'Access-Control-Max-Age'           => '86400',
            'Access-Control-Allow-Headers'     => '*' //'Content-Type, Authorization, X-Requested-With, Origin, Accept,  X-Auth-Token, X-CSRF-TOKEN, xsrf-token, X-Total-Results, Content-Disposition'
        ];

        if ($request->isMethod('OPTIONS'))
        {
            return response()->json('{"method":"OPTIONS"}', 200, $headers);
        }

        $response = $next($request);
        $response->headers->set('Access-Control-Expose-Headers', 'Content-Disposition');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, PATCH, DELETE, OPTIONS');

        //return $response->withHeaders($headers);
        return $response;

    }

}
