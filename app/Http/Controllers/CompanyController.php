<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
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
     * 	path="/api/companies",
     *  operationId="index",
     * 	summary="Return all the companies",
	 * 	tags={"Companies"},
	 * 	@OA\Response(
     *		response=200,
     *		description="List of all the companies registered",
     *		@OA\JsonContent(
     *		    ref="#/components/schemas/CompanySchema",
     *           example={"response": {
     *              "data":{
     *                 "id": 1,
     *                 "identification_type": "01",
     *                 "legal_id": "123456789",
     *                 "name": "Piso 83",
     *                 "business_name": "Piso 83 Digital",
     *                 "description": "",
     *                 "email": "hello@piso83digital.com",
     *                 "phone": "60061983",
     *                 "country": "506",
     *                 "province": null,
     *                 "canton": null,
     *                 "district": null,
     *                 "address": "Santa Jose",
     *                 "website": "https://www.piso83digital.com/",
     *                 "image": "icon-piso833.svg",
     *                 "note": "Pre-Registro",
     *                 "is_active": "1",
     *                 "is_deleted": "0",
     *                 "created_at": "2021-06-30T00:21:57.000000Z",
     *                 "updated_at": "2021-06-30T00:21:57.000000Z"
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
        $data = Company::where( 'is_active', true )->where( 'is_deleted', false )->get(  );
		if ( $request->wantsJson(  ) ) {
			return $data;
            //return $data->toJson(  );
		}
    }

    /**
	 * @OA\GET(
     * 	path="/api/companies/list",
     *  operationId="list",
     * 	summary="Return a paginated list of all the companies registered",
	 * 	tags={"Companies"},
	 * 	@OA\Response(
     *		response=200,
     *		description="A paginated list of all the companies registered",
     *		@OA\JsonContent(
     *		    ref="#/components/schemas/CompanySchema",
     *           example={"response": {
     *              "data":{
     *                 "id": 1,
     *                 "identification_type": "01",
     *                 "legal_id": "123456789",
     *                 "name": "Piso 83",
     *                 "business_name": "Piso 83 Digital",
     *                 "description": "",
     *                 "email": "hello@piso83digital.com",
     *                 "phone": "60061983",
     *                 "country": "506",
     *                 "province": null,
     *                 "canton": null,
     *                 "district": null,
     *                 "address": "Santa Jose",
     *                 "website": "https://www.piso83digital.com/",
     *                 "image": "icon-piso833.svg",
     *                 "note": "Pre-Registro",
     *                 "is_active": "1",
     *                 "is_deleted": "0",
     *                 "created_at": "2021-06-30T00:21:57.000000Z",
     *                 "updated_at": "2021-06-30T00:21:57.000000Z"
     *               },
     *               "current_page": 1,
     *               "from": 1,
     *               "last_page": 1,
     *               "per_page": 15,
     *               "to": 1,
     *               "total": 1,
     *               "first_page_url": "/api/companies/list?page=1",
     *               "last_page_url": "/api/companies/list?page=1",
     *               "path": "/api/companies/list",
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
        $data = Company::where( 'is_active', true )->where( 'is_deleted', false )->paginate( 15 );

		if ( $request->wantsJson(  ) ) {
			return $data;
            //return $data->toJson(  );
		}
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\POST(
     * 	path="/api/companies",
     *  operationId="store",
     * 	summary="Create Company Method",
     * 	tags={"Companies"},
     * @OA\Parameter(
     *      name="name",
     *      in="query",
     *      description="Write company's name",
     *      required=true,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="business_name",
     *      in="query",
     *      description="Write company's business name",
     *      required=true,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="identification_type",
     *      in="query",
     *      description="Write the identification type",
     *      required=false,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="legal_id",
     *      in="query",
     *      description="Write company legal ID",
     *      required=false,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     *  @OA\Parameter(
     *      name="description",
     *      in="query",
     *      description="Write company's description",
     *      required=false,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="email",
     *      in="query",
     *      description="Write company's email",
     *      required=true,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="country",
     *      in="query",
     *      description="Write company's country",
     *      required=true,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="phone",
     *      in="query",
     *      description="Write company phone",
     *      required=false,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="address",
     *      in="query",
     *      description="Write company address",
     *      required=false,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="province",
     *      in="query",
     *      description="Write company province",
     *      required=false,
     *      @OA\Schema(
     *          type="integer",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="canton",
     *      in="query",
     *      description="Write company canton",
     *      required=false,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="district",
     *      in="query",
     *      description="Write company district",
     *      required=false,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="website",
     *      in="query",
     *      description="Write company web site",
     *      required=false,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="image",
     *      in="query",
     *      description="Write image name",
     *      required=false,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * 	@OA\Response(
     * 		response=201,
     *		description="Create Company",
     *		@OA\JsonContent(
     *		    ref="#/components/schemas/CompanySchema",
     *          example={"response": {
     *              "data":{
     *                 "id": 1,
     *                 "identification_type": "01",
     *                 "legal_id": "123456789",
     *                 "name": "Piso 83",
     *                 "business_name": "Piso 83 Digital",
     *                 "description": "",
     *                 "email": "hello@piso83digital.com",
     *                 "phone": "60061983",
     *                 "country": "506",
     *                 "province": null,
     *                 "canton": null,
     *                 "district": null,
     *                 "address": "Santa Jose",
     *                 "website": "https://www.piso83digital.com/",
     *                 "image": "icon-piso833.svg",
     *                 "note": "Pre-Registro",
     *                 "is_active": "1",
     *                 "is_deleted": "0",
     *                 "created_at": "2021-06-30T00:21:57.000000Z",
     *                 "updated_at": "2021-06-30T00:21:57.000000Z"
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
     *  security={ {"bearerAuth": {} } }
     * )
     */
    public function store( Request $request )
    {
        // Validate incoming request
        $this->validate( $request, [
            'name' => 'required|string|max:100',
            'business_name' => 'required|string|max:100',
            'description' => 'nullable|string|max:250',
            'identification_type' => 'nullable||string|max:2',
            'legal_id' => 'nullable||string|max:15',
            'email' => 'required|email|max:100',
            'country' => 'required|string|max:4',
            'phone' => 'nullable||string|max:12',
            'address' => 'nullable||string|max:250',
            'province' => 'nullable||string|max:50',
            'canton' => 'nullable||string|max:50',
            'district' => 'nullable||string|max:50',
            'website' => 'nullable|string|max:100',
            'image' => 'nullable|string|max:250',
            'note' => 'nullable|string|max:250'
        ] );
        $current_time = new \DateTime(  );
        try {
            //
            $in_data = Company::create( [
                'name' => $request->input( 'name' ),
                'business_name' => $request->input( 'business_name' ),
                'identification_type' => $request->input( 'identification_type' ),
                'description' => $request->input( 'description' ),
                'legal_id' => $request->input( 'legal_id' ),
                'email' => $request->input( 'email' ),
                'country' => $request->input( 'country' ),
                'phone' => $request->input( 'phone' ),
                'address' => $request->input( 'address' ),
                'province' => $request->input( 'province' ),
                'canton' => $request->input( 'canton' ),
                'district' => $request->input( 'district' ),
                'address' => $request->input( 'address' ),
                'website' => $request->input( 'website' ),
                'image' => $request->input( 'image' ),
                'is_active' => true,
                'created' => $current_time->format( "Y-m-d H:i:s" ),
                'modified' => $current_time->format( "Y-m-d H:i:s" )
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
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    /**
	 * @OA\GET(
     * 	path="/api/companies/{id}",
     *  operationId="show",
     * 	summary="Show company",
	 * 	tags={"Companies"},
     *  @OA\Parameter(
     *      name="id",
     *      in="path",
     *      description="Company ID",
     *      required=true,
     *      @OA\Schema(
     *          type="integer",
     *          format="int64",
     *          minimum=1
     *      ),
     *  ),
	 * 	@OA\Response(
     *		response=200,
     *		description="Show Company",
     *		@OA\JsonContent(
     *		    ref="#/components/schemas/CompanySchema",
     *          example={"response": {
     *              "data":{
     *                 "id": 1,
     *                 "identification_type": "01",
     *                 "legal_id": "123456789",
     *                 "name": "Piso 83",
     *                 "business_name": "Piso 83 Digital",
     *                 "description": "",
     *                 "email": "hello@piso83digital.com",
     *                 "phone": "60061983",
     *                 "country": "506",
     *                 "province": null,
     *                 "canton": null,
     *                 "district": null,
     *                 "address": "Santa Jose",
     *                 "website": "https://www.piso83digital.com/",
     *                 "image": "icon-piso833.svg",
     *                 "note": "Pre-Registro",
     *                 "is_active": "1",
     *                 "is_deleted": "0",
     *                 "created_at": "2021-06-30T00:21:57.000000Z",
     *                 "updated_at": "2021-06-30T00:21:57.000000Z"
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
        $data = Company::where( 'is_active', true )->where( 'is_deleted', false )->where( 'id', $id )->firstOrFail(  );

		if ( $request->wantsJson(  ) ) {
			return $data;
            //return $data->toJson(  );
		}
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\PUT(
     * 	path="/api/companies",
     *  operationId="update",
     * 	summary="Update Company Method",
     * 	tags={"Companies"},
     * @OA\Parameter(
     *      name="id",
     *      in="path",
     *      description="Company ID",
     *      required=true,
     *      @OA\Schema(
     *          type="integer",
     *          format="int64",
     *          minimum=1
     *      ),
     * ),
     * @OA\Parameter(
     *      name="name",
     *      in="query",
     *      description="Write company's name",
     *      required=true,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="business_name",
     *      in="query",
     *      description="Write company's business name",
     *      required=true,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="identification_type",
     *      in="query",
     *      description="Write the identification type",
     *      required=false,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="legal_id",
     *      in="query",
     *      description="Write company legal ID",
     *      required=false,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     *  @OA\Parameter(
     *      name="description",
     *      in="query",
     *      description="Write company's description",
     *      required=false,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="email",
     *      in="query",
     *      description="Write company's email",
     *      required=true,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="country",
     *      in="query",
     *      description="Write company's country",
     *      required=true,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="phone",
     *      in="query",
     *      description="Write company phone",
     *      required=false,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="address",
     *      in="query",
     *      description="Write company address",
     *      required=false,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="province",
     *      in="query",
     *      description="Write company province",
     *      required=false,
     *      @OA\Schema(
     *          type="integer",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="canton",
     *      in="query",
     *      description="Write company canton",
     *      required=false,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="district",
     *      in="query",
     *      description="Write company district",
     *      required=false,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="website",
     *      in="query",
     *      description="Write company web site",
     *      required=false,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="image",
     *      in="query",
     *      description="Write image name",
     *      required=false,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * 	@OA\Response(
     * 		response=201,
     *		description="Update Company",
     *		@OA\JsonContent(
     *		    ref="#/components/schemas/CompanySchema",
     *          example={"response": {
     *              "data":{
     *                 "id": 1,
     *                 "identification_type": "01",
     *                 "legal_id": "123456789",
     *                 "name": "Piso 83",
     *                 "business_name": "Piso 83 Digital",
     *                 "description": "",
     *                 "email": "hello@piso83digital.com",
     *                 "phone": "60061983",
     *                 "country": "506",
     *                 "province": null,
     *                 "canton": null,
     *                 "district": null,
     *                 "address": "Santa Jose",
     *                 "website": "https://www.piso83digital.com/",
     *                 "image": "icon-piso833.svg",
     *                 "note": "Pre-Registro",
     *                 "is_active": "1",
     *                 "is_deleted": "0",
     *                 "created_at": "2021-06-30T00:21:57.000000Z",
     *                 "updated_at": "2021-06-30T00:21:57.000000Z"
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
        $data = Company::where( 'id', $id )->firstOrFail(  );
        // Validate incoming request
        $this->validate( $request, [
            'name' => 'required|string|max:100',
            'business_name' => 'required|string|max:100',
            'description' => 'nullable|string|max:250',
            'identification_type' => 'nullable||string|max:2',
            'legal_id' => 'nullable||string|max:15',
            'email' => 'required|email|max:100',
            'country' => 'required|string|max:4',
            'phone' => 'nullable||string|max:12',
            'address' => 'nullable||string|max:250',
            'province' => 'nullable||string|max:50',
            'canton' => 'nullable||string|max:50',
            'district' => 'nullable||string|max:50',
            'website' => 'nullable|string|max:100',
            'image' => 'nullable|string|max:250',
            'note' => 'nullable|string|max:250'
        ] );

        $current_time = new \DateTime(  );
        try {

            $data->fill( [
                'name' => $request->input( 'name' ),
                'business_name' => $request->input( 'business_name' ),
                'description' => $request->input( 'description' ),
                'identification_type' => $request->input( 'identification_type' ),
                'legal_id' => $request->input( 'legal_id' ),
                'email' => $request->input( 'email' ),
                'country' => $request->input( 'country' ),
                'phone' => $request->input( 'phone' ),
                'address' => $request->input( 'address' ),
                'province' => $request->input( 'province' ),
                'canton' => $request->input( 'canton' ),
                'district' => $request->input( 'district' ),
                'website' => $request->input( 'website' ),
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
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    /**
	 * @OA\DELETE(
     * 	path="/api/companies/{id}",
     *  operationId="destroy",
     * 	summary="Delete company",
	 * 	tags={"Companies"},
     *  @OA\Parameter(
     *      name="id",
     *      in="path",
     *      description="Company ID",
     *      required=true,
     *      @OA\Schema(
     *          type="integer",
     *          format="int64",
     *          minimum=1
     *      ),
     *  ),
	 * 	@OA\Response(
     *		response=200,
     *		description="Delete Company",
     *		@OA\JsonContent(
     *		    ref="#/components/schemas/CompanySchema",
     *          example={"response": {
     *              "data":{
     *                 "id": 1,
     *                 "identification_type": "01",
     *                 "legal_id": "123456789",
     *                 "name": "Piso 83",
     *                 "business_name": "Piso 83 Digital",
     *                 "description": "",
     *                 "email": "hello@piso83digital.com",
     *                 "phone": "60061983",
     *                 "country": "506",
     *                 "province": null,
     *                 "canton": null,
     *                 "district": null,
     *                 "address": "Santa Jose",
     *                 "website": "https://www.piso83digital.com/",
     *                 "image": "icon-piso833.svg",
     *                 "note": "Pre-Registro",
     *                 "is_active": "1",
     *                 "is_deleted": "0",
     *                 "created_at": "2021-06-30T00:21:57.000000Z",
     *                 "updated_at": "2021-06-30T00:21:57.000000Z"
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
        $data = Company::findOrFail( $id );
        $data->is_deleted = true;
        $data->save(  );

        if ( $request->wantsJson(  ) ) {
            return $data;
            //return $data->toJson(  );
        }
    }

    /**
	 * @OA\POST(
     * 	path="/api/companies/search",
     *  operationId="search",
     * 	summary="Search a Company",
	 * 	tags={"Companies"},
     * @OA\Parameter(
     *      name="name",
     *      in="query",
     *      description="Write the company name",
     *      required=false,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="legal_id",
     *      in="query",
     *      description="Write the company legal id",
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
     *		description="Search companies",
     *		@OA\JsonContent(
     *		    ref="#/components/schemas/CompanySchema",
     *           example={"response": {
     *              "data":{
     *                 "id": 1,
     *                 "identification_type": "01",
     *                 "legal_id": "123456789",
     *                 "name": "Piso 83",
     *                 "business_name": "Piso 83 Digital",
     *                 "description": "",
     *                 "email": "hello@piso83digital.com",
     *                 "phone": "60061983",
     *                 "country": "506",
     *                 "province": null,
     *                 "canton": null,
     *                 "district": null,
     *                 "address": "Santa Jose",
     *                 "website": "https://www.piso83digital.com/",
     *                 "image": "icon-piso833.svg",
     *                 "note": "Pre-Registro",
     *                 "is_active": "1",
     *                 "is_deleted": "0",
     *                 "created_at": "2021-06-30T00:21:57.000000Z",
     *                 "updated_at": "2021-06-30T00:21:57.000000Z"
     *               },
     *               "current_page": 1,
     *               "from": 1,
     *               "last_page": 1,
     *               "per_page": 15,
     *               "to": 1,
     *               "total": 1,
     *               "first_page_url": "/api/companies/search?page=1",
     *               "last_page_url": "/api/companies/search?page=1",
     *               "path": "/api/companies/search",
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
            'name' => 'nullable|string|max:240',
            'legal_id' => 'nullable|string|min:5|max:20',
            'pagination' => 'nullable|number'
        ] );

        $companies = Company::where( 'is_active', true )->where( 'is_deleted', false );
        if ( $request->name ) {
            $companies->where( 'name', 'LIKE', "%{$request->name}%" )->orWhere( 'business_name', 'LIKE', "%{$request->name}%" );
        }
        if ( $request->legal_id ) {
            $companies->where( 'legal_id', 'LIKE', "%{$request->legal_id}%" );
        }
        if ( $request->paginate ) {
            return $companies->orderBy( 'name', 'ASC' )->paginate( $request->paginate );
        } else {
            return $companies->orderBy( 'name', 'ASC' )->get(  );
        }
    }

}
