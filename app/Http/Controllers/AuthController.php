<?php

namespace App\Http\Controllers;

use App\User;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource as UserResource;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected $jwt;

    public function __construct( JWTAuth $jwt )
    {
        //
        $this->jwt = $jwt;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Post(
     * 	path="/api/login",
     *  operationId="login",
     * 	summary="User Login",
     * 	tags={"Users"},
     *  @OA\Parameter(
     *      name="username",
     *      in="query",
     *      description="Write your username",
     *      required=true,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     *  @OA\Parameter(
     *      name="password",
     *      in="query",
     *      description="Write your password",
     *      required=true,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * 	@OA\Response(
     * 		response=200,
     *		description="User Login",
     *		@OA\JsonContent(
     *		    ref="#/components/schemas/UserSchema",
     *           example={
     *               "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwODAvbG9naW4iLCJpYXQiOjE1NzkxMzQzMTIsImV4cCI6MTU3OTEzNzkxMiwibmJmIjoxNTc5MTM0MzEyLCJqdGkiOiJaWWhaWnZVd1lBVE9lbDlwIiwic3ViIjoyLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.wU3zGJO1SPWwtwDeRA4amxtkDxySnGdAq301ARSoVQs"
     *           }
     *		)
     *	),
     *	@OA\Response(
     *       response="default",
     *       description="Error: Bad request. When required parameters were not supplied.",
     *   ),
     * )
     */
    public function login( Request $request )
    {
        $this->validate( $request, [
            'username' => 'required|max:50',
            'password' => 'required',
        ] );
        //$user = User::find( 3712 );
        $username = $request->username;
        $password = hash( 'sha256', $request->password );
        $user = User::where( 'username', $username )->where( 'clave', $password )->first(  );
        //
        try {
            if ( !$user ) {
                return response(  )->json( ['error'=> 'user_not_found'], 404 );
            }
            if ( !$token = $this->jwt->fromUser( $user ) ) {
                //return response()->json(['user_not_found'], 404);
                return response(  )->json( ['token' => '','error'=> 'user_not_found'], 404 );
            }
        } catch ( \Tymon\JWTAuth\Exceptions\TokenExpiredException $e ) {
            return response(  )->json( ['token_expired'], 500 );
        } catch ( \Tymon\JWTAuth\Exceptions\TokenInvalidException $e ) {
            return response(  )->json( ['token_invalid'], 500 );
        } catch ( \Tymon\JWTAuth\Exceptions\JWTException $e ) {
            return response(  )->json( ['token_absent' => $e->getMessage(  )], 500 ) ;
        }

        return response(  )->json( compact( 'token' ) );

    }

    /**
     * @OA\GET(
     * 	path="/api/me",
     *  operationId="me",
     * 	summary="Get User Data",
     * 	tags={"Users"},
     * 	@OA\Response(
     * 		response=200,
     *		description="Get User Data",
     *		@OA\JsonContent(
     *		    ref="#/components/schemas/UserSchema",
     *           example={"response": {
     *              "data":{
     *                 "id": "1",
     *                 "name": "Alberto Molina",
     *                 "username": "nmolina",
     *                 "email": "mail@mail.com",
     *                 "address": "San Jose",
     *                 "phone": "72906930",
     *                 "legal_id": "155829822903",
     *                 "occupation": "Developer",
     *                 "is_active": "1",
     *                 "activation_code": "",
     *                 "is_admin": "0",
     *                 "last_login": "0000-00-00 00:00:00",
     *                 "status": "1",
     *                 "usrtype_id": "5",
     *                 "change_pass": "1",
     *                 "created_at": "0000-00-00 00:00:00",
     *                 "updated_at": "0000-00-00 00:00:00"
     *               },
     *             }
     *          }
     *		)
     *	),
     *	@OA\Response(
     *       response="default",
     *       description="Error: Bad request. When required parameters were not supplied.",
     *   ),
     *  @OA\Response(
     *         response=401,
     *         description="Check Token"
     *  ),
     *  security={ {"bearerAuth": {} } }
     * )
     */
    public function me(  )
    {
        $id = $this->guard(  )->user(  )[ 'id' ];
        return new UserResource( User::where( 'id', $id )->first(  ) );
        //return response(  )->json( $this->guard(  )->user(  )[ 'id' ] );
    }

    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     * @OA\POST(
     * 	path="/api/logout",
     *  operationId="logout",
     * 	summary="Close Session",
     * 	tags={"Users"},
     * 	@OA\Response(
     * 		response=200,
     *		description="Close Session",
     *		@OA\JsonContent(
     *		    ref="#/components/schemas/UserSchema",
     *           example= {
     *              "message": "Successfully logged out"
     *          }
     *		)
     *	),
     *	@OA\Response(
     *       response="default",
     *       description="Error: Bad request. When required parameters were not supplied.",
     *   ),
     *  @OA\Response(
     *         response=401,
     *         description="Check Token"
     *  ),
     *  security={ {"bearerAuth": {} } }
     * )
     */
    public function logout(  )
    {
        $this->guard(  )->logout(  );

        return response(  )->json( ['message' => 'Successfully logged out'] );
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     * @OA\PUT(
     * 	path="/api/refresh",
     *  operationId="refresh",
     * 	summary="Refresh Access Token",
     * 	tags={"Users"},
     * 	@OA\Response(
     * 		response=200,
     *		description="Refresh Access Token",
     *		@OA\JsonContent(
     *		    ref="#/components/schemas/UserSchema",
     *           example= {
     *              "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwODAvYXBpL3JlZnJlc2giLCJpYXQiOjE1ODAzMzM5MzksImV4cCI6MTU4MDMzNzY5NCwibmJmIjoxNTgwMzM0MDk0LCJqdGkiOiJOc1hyVzYwWENsZXYzUWNvIiwic3ViIjoyLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.YUpV3uLbsv49kL5qwPShJsM-9U9AaCnkToBHUd4SNmk",
     *              "token_type": "bearer",
     *              "expires_in": 3600
     *          }
     *		)
     *	),
     *	@OA\Response(
     *       response="default",
     *       description="Error: Bad request. When required parameters were not supplied.",
     *   ),
     *  @OA\Response(
     *         response=401,
     *         description="Check Token"
     *  ),
     *  security={ {"bearerAuth": {} } }
     * )
     */
    public function refresh(  )
    {
        return $this->respondWithToken( $this->guard(  )->refresh(  ) );
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken( $token )
    {
        return response(  )->json( [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard(  )->factory(  )->getTTL(  ) * 60
        ] );
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard(  )
    {
        return Auth::guard(  );
    }


}
