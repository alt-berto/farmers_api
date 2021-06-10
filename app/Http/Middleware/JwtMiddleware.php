<?php

namespace App\Http\Middleware;

use DB;
use Closure;
use Exception;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Config;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class JwtMiddleware extends BaseMiddleware
{
    use ApiResponser;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle( Request $request, Closure $next )
    {
        //
        try {
            $user = JWTAuth::parseToken(  )->authenticate(  );
        } catch ( Exception $e ) {
            if ( $e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException ) {
                return $this->errorResponse( ['status' => 'Token is Invalid'], Response::HTTP_UNAUTHORIZED );
                //return response(  )->json( ['status' => 'Token is Invalid'] );
            } else if ( $e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException ) {
                return $this->errorResponse( ['status' => 'Token is Expired'], Response::HTTP_UNAUTHORIZED );
                //return response(  )->json( ['status' => 'Token is Expired'] );
            } else {
                return $this->errorResponse( ['status' => 'Authorization Token not found'], Response::HTTP_UNAUTHORIZED );
                //return response(  )->json( ['status' => 'Authorization Token not found'] );
            }
        }
        return $next( $request );
    }
}
