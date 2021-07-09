<?php

namespace App\Http\Controllers;

use JWTAuth;
use App\User;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected $jwt;

    public function __construct(  )
    {
        //
        //$this->jwt = $jwt;
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
            'username' => 'required|max:60',
            'password' => 'required',
        ] );

        $credentials = $request->only('username', 'password');
        //
        try {
            if ( ! $token = JWTAuth::attempt( $credentials ) ) {
                //return response()->json(['user_not_found'], 404);
                return response(  )->json( ['token' => '','message'=> 'credenciales_invalidas'], 400 );
            }
        } catch ( \Tymon\JWTAuth\Exceptions\TokenExpiredException $e ) {
            return response(  )->json( ['token_expiro'], 500 );
        } catch ( \Tymon\JWTAuth\Exceptions\TokenInvalidException $e ) {
            return response(  )->json( ['token_invalido'], 500 );
        } catch ( \Tymon\JWTAuth\Exceptions\JWTException $e ) {
            return response(  )->json( ['token_ausente' => $e->getMessage(  )], 500 ) ;
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
     *              "user":{
     *                 "id": 1,
     *                 "company_id": "1",
     *                 "first_name": "Nestor Alberto",
     *                 "last_name": "Molina Moran",
     *                 "partner_number": null,
     *                 "company_name": null,
     *                 "birthday": null,
     *                 "gender": "0",
     *                 "username": "alt_berto",
     *                 "email": "alberto@piso83digital.com",
     *                 "email_verified_at": null,
     *                 "phone": "72906930",
     *                 "country": null,
     *                 "province": null,
     *                 "canton": null,
     *                 "district": null,
     *                 "address": "Santa Ana, Brasil de Mora.",
     *                 "zip": null,
     *                 "points": null,
     *                 "image": null,
     *                 "note": "Pre-Registro",
     *                 "is_admin": "1",
     *                 "is_active": "1",
     *                 "is_deleted": "0",
     *                 "remember_token": null,
     *                 "created_at": "2021-06-30T00:21:57.000000Z",
     *                 "updated_at": "2021-06-30T00:21:57.000000Z",
     *                 "company": {
     *                     "id": 1,
     *                     "identification_type": "01",
     *                     "legal_id": "123456789",
     *                     "name": "Piso 83",
     *                     "business_name": "Piso 83 Digital",
     *                     "description": "",
     *                     "email": "hello@piso83digital.com",
     *                     "phone": "60061983",
     *                     "country": "506",
     *                     "province": null,
     *                     "canton": null,
     *                     "district": null,
     *                     "address": "Santa Jose",
     *                     "website": "https://www.piso83digital.com/",
     *                     "image": "icon-piso833.svg",
     *                     "note": "Pre-Registro",
     *                     "is_active": "1",
     *                     "is_deleted": "0",
     *                     "created_at": "2021-06-30T00:21:57.000000Z",
     *                     "updated_at": "2021-06-30T00:21:57.000000Z"
     *                 }
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
        try {
            if ( !$id = JWTAuth::parseToken(  )->authenticate(  ) ) {
                    return response()->json(['usuario_no_encontrado'], 404);
            }
        } catch ( \Tymon\JWTAuth\Exceptions\TokenExpiredException $e ) {
            return response(  )->json( ['token_expiro'], 500 );
        } catch ( \Tymon\JWTAuth\Exceptions\TokenInvalidException $e ) {
            return response(  )->json( ['token_invalido'], 500 );
        } catch ( \Tymon\JWTAuth\Exceptions\JWTException $e ) {
            return response(  )->json( ['token_ausente' => $e->getMessage(  )], 500 ) ;
        }
        $user = User::with( 'company' )->where( 'id', $id->id )->first(  );
        return response(  )->json( compact( 'user' ) );
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
        auth(  )->logout(  );

        return response(  )->json( ['message' => 'Cierre de sessión completado'] );
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
        return $this->createNewToken( auth(  )->refresh(  ) );
    }


    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken( $token ) {
        return response(  )->json( [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth(  )->factory(  )->getTTL(  ) * 60,
            'user' => auth(  )->user(  )
        ] );
    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     * @OA\POST(
     * 	path="/api/register",
     *  operationId="register",
     * 	summary="Sing up User, the partner number is: TEST2021",
     * 	tags={"Users"},
     * @OA\Parameter(
     *      name="company_id",
     *      in="query",
     *      description="Write the company ID",
     *      required=false,
     *      @OA\Schema(
     *          type="integer",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="first_name",
     *      in="query",
     *      description="Write your first name",
     *      required=true,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     *  @OA\Parameter(
     *      name="last_name",
     *      in="query",
     *      description="Write your last name",
     *      required=true,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="email",
     *      in="query",
     *      description="Write your email address",
     *      required=true,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="username",
     *      in="query",
     *      description="Write your username",
     *      required=true,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="phone",
     *      in="query",
     *      description="Write your phone number",
     *      required=true,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="gender",
     *      in="query",
     *      description="Write your gender",
     *      required=true,
     *      @OA\Schema(
     *          type="integer",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="company_name",
     *      in="query",
     *      description="Write your company name",
     *      required=true,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="partner_number",
     *      in="query",
     *      description="Write your partner number",
     *      required=true,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="birthday",
     *      in="query",
     *      description="Write your birthday",
     *      required=true,
     *      @OA\Schema(
     *          type="date",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="country",
     *      in="query",
     *      description="Write your country",
     *      required=false,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="province",
     *      in="query",
     *      description="Write your province",
     *      required=false,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="canton",
     *      in="query",
     *      description="Write your canton",
     *      required=false,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="district",
     *      in="query",
     *      description="Write your district",
     *      required=false,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="zip",
     *      in="query",
     *      description="Write your zip code",
     *      required=false,
     *      @OA\Schema(
     *          type="integer",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="address",
     *      in="query",
     *      description="Write your address",
     *      required=false,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),

     * @OA\Parameter(
     *      name="points",
     *      in="query",
     *      description="Write the points",
     *      required=false,
     *      @OA\Schema(
     *          type="integer",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="image",
     *      in="query",
     *      description="Write the image name",
     *      required=false,
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
     * @OA\Parameter(
     *      name="password_confirmation",
     *      in="query",
     *      description="Write the same password",
     *      required=true,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * 	@OA\Response(
     * 		response=201,
     *		description="Create User",
     *		@OA\JsonContent(
     *		    ref="#/components/schemas/UserSchema",
     *           example={"response": {
     *              "user":{
     *                 "id": 1,
     *                 "company_id": "1",
     *                 "first_name": "Nestor Alberto",
     *                 "last_name": "Molina Moran",
     *                 "partner_number": null,
     *                 "company_name": null,
     *                 "birthday": null,
     *                 "gender": "0",
     *                 "username": "alt_berto",
     *                 "email": "alberto@piso83digital.com",
     *                 "email_verified_at": null,
     *                 "phone": "72906930",
     *                 "country": null,
     *                 "province": null,
     *                 "canton": null,
     *                 "district": null,
     *                 "address": "Santa Ana, Brasil de Mora.",
     *                 "zip": null,
     *                 "points": null,
     *                 "image": null,
     *                 "note": "Pre-Registro",
     *                 "is_admin": "1",
     *                 "is_active": "1",
     *                 "is_deleted": "0",
     *                 "remember_token": null,
     *                 "created_at": "2021-06-30T00:21:57.000000Z",
     *                 "updated_at": "2021-06-30T00:21:57.000000Z",
     *               },
     *             }
     *
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
     *  @OA\Response(
     *         response=405,
     *         description="Validation exception"
     *  ),
     *  @OA\Response(
     *         response=409,
     *         description="Registration Failed"
     *  ),
     * )
     */
    public function register( Request $request ) {
        $this->validate( $request, [
            'company_id' => 'numeric|nullable',
            'first_name' => 'required|string|between:3,60',
            'last_name' => 'required|string|between:3,60',
            'username' => 'required|string|between:3,60',
            'email' => 'required|string|email|max:100|unique:users',
            'phone' => 'required|string|between:7,14',
            'gender' => 'required|numeric',
            'partner_number' => 'required|string|max:50',
            'company_name' => 'required|string|between:3,60',
            'birthday' => 'nullable|string',
            'country' => 'nullable|string|max:50',
            'province' => 'nullable|string|max:50',
            'canton' => 'nullable|string|max:50',
            'district' => 'nullable|string|max:50',
            'zip' => 'nullable|numeric',
            'address' => 'nullable|string|max:50',
            'points' => 'nullable|numeric',
            'image' => 'nullable|string',
            'password' => 'required|string|confirmed|min:6',
        ]);

        if ( $request->input( 'partner_number' ) != env( 'PARTNER_NUMBER' ) ) {
            return response(  )->json( [ 'message' => 'Código distribuidor invalido' ], 404 );
        }

        $current_time = new \DateTime(  );
        $user = User::create( [
            'company_id' => $request->input( 'company_id' ),
            'first_name' => $request->input( 'first_name' ),
            'last_name' => $request->input( 'last_name' ),
            'username' => $request->input( 'username' ),
            'email' => $request->input( 'email' ),
            'phone' => $request->input( 'phone' ),
            'gender' => $request->input( 'gender' ),
            'company_name' => $request->input( 'company_name' ),
            'birthday' => $request->input( 'birthday' ),
            'country' => $request->input( 'country' ),
            'province' => $request->input( 'province' ),
            'canton' => $request->input( 'canton' ),
            'district' => $request->input( 'district' ),
            'zip' => $request->input( 'zip' ),
            'address' => $request->input( 'address' ),
            'points' => $request->input( 'points' ),
            'image' => $request->input( 'image' ),
            'password' => Hash::make( $request->input( 'password' ) ),
            'is_active' => true,
            'created_at' => $current_time->format( "Y-m-d H:i:s" ),
            'updated_at' => $current_time->format( "Y-m-d H:i:s" )

        ] );

        return response(  )->json ([
            'message' => 'Usuario creado correctamente',
            'user' => $user
        ], 201 );
    }


}
