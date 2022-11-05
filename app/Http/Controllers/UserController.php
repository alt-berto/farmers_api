<?php

namespace App\Http\Controllers;

use App\User;
use App\UserCode;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;

class UserController extends Controller
{
    use ApiResponser;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
	 * @OA\GET(
     * 	path="/api/users",
     *  operationId="index",
     * 	summary="Return all the users",
	 * 	tags={"Users"},
	 * 	@OA\Response(
     *		response=200,
     *		description="List of all the users registered",
     *		@OA\JsonContent(
     *		    ref="#/components/schemas/UserSchema",
     *           example={"response": {
     *              "data":{
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
     *  security={ {"bearerAuth": {} } }
	 * )
	 */

    public function index( Request $request )
    {
        //
        $data = User::with( 'company' )->where( 'is_active', true )->where( 'is_deleted', false )->get(  );
		if ( $request->wantsJson(  ) ) {
			return $data;
            //return $data->toJson(  );
		}
    }

    /**
	 * @OA\GET(
     * 	path="/api/users/list",
     *  operationId="list",
     * 	summary="Return a paginated list of all the users registered",
	 * 	tags={"Users"},
	 * 	@OA\Response(
     *		response=200,
     *		description="A paginated list of all the users registered",
     *		@OA\JsonContent(
     *		    ref="#/components/schemas/UserSchema",
     *           example={"response": {
     *              "data":{
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
     *               "current_page": 1,
     *               "from": 1,
     *               "last_page": 1,
     *               "per_page": 15,
     *               "to": 1,
     *               "total": 1,
     *               "first_page_url": "/api/users/list?page=1",
     *               "last_page_url": "/api/users/list?page=1",
     *               "path": "/api/users/list",
     *               "prev_page_url": null,
     *               "next_page_url": null,
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
     *  security={ {"bearerAuth": {} } }
	 * )
	 */

    public function list( Request $request )
    {
        //
        $data = User::with( 'company' )->where( 'is_active', true )->where( 'is_deleted', false )->paginate( 15 );

		if ( $request->wantsJson(  ) ) {
			return $data;
            //return $data->toJson(  );
		}
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return object
     */
    /**
     * @OA\POST(
     * 	path="/api/users",
     *  operationId="store",
     * 	summary="Create User Method",
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
     *      name="birthday",
     *      in="query",
     *      description="Write your birthday",
     *      required=false,
     *      @OA\Schema(
     *          type="string",
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
     *          example={"response": {
     *              "data":{
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
     *  )
     * )
     */
    public function store( Request $request )
    {
        // Validate incoming request
        $this->validate( $request, [
            'company_id' => 'numeric|nullable',
            'first_name' => 'required|string|between:3,60',
            'last_name' => 'required|string|between:3,60',
            'username' => 'required|string|between:3,60',
            'email' => 'required|string|email|max:100|unique:users',
            'phone' => 'required|string|between:7,14',
            'gender' => 'required|numeric',
            'partner_number' => 'required|string|max:120',
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
        ] );
        $current_time = new \DateTime();
        $user_code = UserCode::where('key', $request->input('partner_number'))->first();
        $check_partner_code = User::where('partner_number', $user_code->id)->get();
        if ( $user_code ) {
            if (count($check_partner_code) >= $user_code->max_uses) {
                return response()->json( [
                    'success' => false,
                    'message' => "El código de verificación excede la cantidad de usos maximos ($user_code->max_uses)"
                ], 404 );
            }
        } else {
            return response()->json( [
                'success' => false,
                'message' => "El código de verificación ingresado no existe."
            ], 404);
        }

        try {
            //
            $in_data = User::create( [
                'company_id' => $request->input( 'company_id' ),
                'partner_number' => $user_code->id,
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

            //return successful response
            return response()->json( [
                'data' => $in_data,
                'success' => true,
                'message' => 'Se ha agregado correctamente!.'
            ] );

        } catch ( \Exception $e ) {
            //return error message
            //dd('Exception block', $e);
            //return $e;
            return response()->json( [
                'success' => false,
                'message' => 'Hubo un fallo al hacer el registro.'
            ] );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    /**
	 * @OA\GET(
     * 	path="/api/users/{id}",
     *  operationId="show",
     * 	summary="Show User",
	 * 	tags={"Users"},
     *  @OA\Parameter(
     *      name="id",
     *      in="path",
     *      description="User ID",
     *      required=true,
     *      @OA\Schema(
     *          type="integer",
     *          format="int64",
     *          minimum=1
     *      ),
     *  ),
	 * 	@OA\Response(
     *		response=200,
     *		description="Show User",
     *		@OA\JsonContent(
     *		    ref="#/components/schemas/UserSchema",
     *          example={"response": {
     *              "data":{
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
     *
     *          }
     *		)
     *	),
     *	@OA\Response(
     *       response="default",
     *       description="Error: 'Resource not found.",
     *   ),
     *  @OA\Response(
     *         response=400,
     *         description="Invalid ID supplied"
     *  ),
     *  @OA\Response(
     *         response=401,
     *         description="Check Token"
     *  ),
     *  @OA\Response(
     *         response=404,
     *         description="Resources not found"
     *  ),
     *   security={ {"bearerAuth": {} } }
	 * )
	 */
    public function show( $id, Request $request )
    {
        //
        $data = User::with( 'company' )->where( 'is_active', true )->where( 'is_deleted', false )->where( 'id', $id )->firstOrFail(  );

		if ( $request->wantsJson(  ) ) {
			return $data;
            //return $data->toJson(  );
		}
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\PUT(
     * 	path="/api/users",
     *  operationId="update",
     * 	summary="Update User Method",
     * 	tags={"Users"},
     * @OA\Parameter(
     *      name="id",
     *      in="path",
     *      description="User ID",
     *      required=true,
     *      @OA\Schema(
     *          type="integer",
     *          format="int64",
     *          minimum=1
     *      ),
     * ),
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
     *      name="birthday",
     *      in="query",
     *      description="Write your birthday",
     *      required=true,
     *      @OA\Schema(
     *          type="string",
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
     * 	@OA\Response(
     * 		response=201,
     *		description="Update User",
     *		@OA\JsonContent(
     *		    ref="#/components/schemas/UserSchema",
     *          example={"response": {
     *              "data":{
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
     *
     *          }
     *		)
     *	),
     *	@OA\Response(
     *       response="default",
     *       description="Error: Bad request. When required parameters were not supplied.",
     *   ),
     *  @OA\Response(
     *         response=400,
     *         description="Invalid ID supplied"
     *  ),
     *  @OA\Response(
     *         response=401,
     *         description="Check Token"
     *  ),
     *  @OA\Response(
     *         response=404,
     *         description="Resources not found"
     *  ),
     *  @OA\Response(
     *         response=405,
     *         description="Validation exception"
     *  ),
     *  @OA\Response(
     *         response="422",
     *         description="At least one value must change!.",
     *  ),
     *  security={ {"bearerAuth": {} } }
     * )
     */
    public function update( $id, Request $request )
    {
        //
        $data = User::with( 'company' )->where( 'id', $id )->firstOrFail(  );
        // Validate incoming request
        $this->validate( $request, [
            'company_id' => 'numeric|nullable',
            'first_name' => 'required|string|between:3,60',
            'last_name' => 'required|string|between:3,60',
            'username' => 'required|string|between:3,60',
            'email' => 'required|string|email|max:100',
            'phone' => 'required|string|between:7,14',
            'gender' => 'required|numeric',
            //'partner_number' => 'required|string|max:50',
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
        ] );

        $current_time = new \DateTime(  );
        try {

            $data->fill( [
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
                'is_active' => true,
                //'created_at' => $current_time->format( "Y-m-d H:i:s" ),
                'updated_at' => $current_time->format( "Y-m-d H:i:s" )
            ] )->save(  );

            if ( !$data->wasChanged(  ) ) {
                return response()->json( [
                    'success' => false,
                    'message' => 'Tiene que modificar algun dato.'
                ] );
            }

            return response()->json( [
                'data' => $data,
                'success' => true,
                'message' => 'Modificación de datos se efectuo correctamente!.'
            ] );

        } catch ( \Exception $e ) {
            //return error message
            //dd('Exception block', $e);
            return response()->json( [
                'success' => false,
                'message' => 'Modificación de datos fallo!.'
            ] );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    /**
	 * @OA\DELETE(
     * 	path="/api/users/{id}",
     *  operationId="destroy",
     * 	summary="Delete User",
	 * 	tags={"Users"},
     *  @OA\Parameter(
     *      name="id",
     *      in="path",
     *      description="User ID",
     *      required=true,
     *      @OA\Schema(
     *          type="integer",
     *          format="int64",
     *          minimum=1
     *      ),
     *  ),
	 * 	@OA\Response(
     *		response=200,
     *		description="Delete User",
     *		@OA\JsonContent(
     *		    ref="#/components/schemas/UserSchema",
     *          example={"response": {
     *              "data":{
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
     *
     *          }
     *		)
     *	),
     *	@OA\Response(
     *       response="default",
     *       description="Error: 'Resource not found.",
     *   ),
     *  @OA\Response(
     *         response=400,
     *         description="Invalid ID supplied"
     *  ),
     *  @OA\Response(
     *         response=401,
     *         description="Check Token"
     *  ),
     *  @OA\Response(
     *         response=404,
     *         description="Resources not found"
     *  ),
     *   security={ {"bearerAuth": {} } }
	 * )
	 */
    public function destroy( Request $request, $id )
    {
        //
        $data = User::with( 'company' )->findOrFail( $id );
        $data->is_deleted = true;
        $data->save(  );

        if ( $request->wantsJson(  ) ) {
            return $data;
            //return $data->toJson(  );
        }
    }

    /**
	 * @OA\POST(
     * 	path="/api/users/search",
     *  operationId="search",
     * 	summary="Search a User",
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
     *      name="name",
     *      in="query",
     *      description="Write the User's name",
     *      required=false,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="email",
     *      in="query",
     *      description="Write the User's email",
     *      required=false,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="phone",
     *      in="query",
     *      description="Write the User's phone",
     *      required=false,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="gender",
     *      in="query",
     *      description="Write the User's gender",
     *      required=false,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="paginate",
     *      in="query",
     *      description="Write the pagination quantity",
     *      required=false,
     *      @OA\Schema(
     *          type="integer",
     *      ),
     *      style="form"
     *  ),
	 * 	@OA\Response(
     *		response=200,
     *		description="Search users",
     *		@OA\JsonContent(
     *		    ref="#/components/schemas/UserSchema",
     *           example={"response": {
     *              "data":{
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
     *               "current_page": 1,
     *               "from": 1,
     *               "last_page": 1,
     *               "per_page": 15,
     *               "to": 1,
     *               "total": 1,
     *               "first_page_url": "/api/users/search?page=1",
     *               "last_page_url": "/api/users/search?page=1",
     *               "path": "/api/users/search",
     *               "prev_page_url": null,
     *               "next_page_url": null,
     *             }
     *          }
     *		)
     *	),
     *	@OA\Response(
     *       response="default",
     *       description="Error: 'Resource not found.",
     *   ),
     *  @OA\Response(
     *         response=400,
     *         description="Invalid ID supplied"
     *  ),
     *  @OA\Response(
     *         response=401,
     *         description="Check Token"
     *  ),
     *  @OA\Response(
     *         response=404,
     *         description="Resources not found"
     *  ),
     *   security={ {"bearerAuth": {} } }
	 * )
	 */
    public function search( Request $request )
    {
        //
        $this->validate( $request, [
            'company_id' => 'nullable|number',
            'name' => 'nullable|string|max:80',
            'email' => 'nullable|string|max:100',
            'phone' => 'nullable|string|max:14',
            'gender' => 'nullable|number',
            'company_name' => 'nullable|string|max:14',
            'pagination' => 'nullable|number'
        ] );

        $users = User::with( 'company' )->where( 'is_active', true )->where( 'is_deleted', false );
        if ( $request->name ) {
            $users->where( 'first_name', 'LIKE', "%{$request->name}%" )->orWhere( 'last_name', 'LIKE', "%{$request->name}%" )->orWhere( 'username', 'LIKE', "%{$request->name}%" );
        }
        if ( $request->email ) {
            $users->where( 'email', 'LIKE', "%{$request->email}%" );
        }
        if ( $request->phone ) {
            $users->where( 'phone', 'LIKE', "%{$request->phone}%" );
        }
        if ( $request->gender ) {
            $users->where( 'gender', $request->gender );
        }
        if ( $request->company_id ) {
            $users->where( 'company_id', $request->company_id );
        }
        if ( $request->company_name ) {
            $users->where( 'company_name', 'LIKE', "%{$request->company_name}%" );
        }
        if ( $request->paginate ) {
            return $users->orderBy( 'name', 'ASC' )->paginate( $request->paginate );
        } else {
            return $users->orderBy( 'name', 'ASC' )->get(  );
        }
    }

}
