<?php

namespace App\Http\Controllers;

use App\UserCode;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;

class UserCodeController extends Controller
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
     * @return object
     */
    /**
     * @OA\GET(
     * 	path="/api/user/codes",
     *  operationId="index",
     * 	summary="Return all user codes",
     * 	tags={"UserCodes"},
     * 	@OA\Response(
     *		response=200,
     *		description="List of all the user codes registered",
     *		@OA\JsonContent(
     *		    ref="#/components/schemas/UserCodeSchema",
     *           example={"response": {
     *              "data":{
     *                 "id": 1,
     *                 "key": "3caff61cb19d855503fe",
     *                 "max_uses": "5",
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
    public function index(  ) : object
    {
        return UserCode::where( 'is_active', true )->where( 'is_deleted', false )->get(  );
    }

    /**
     * @OA\GET(
     * 	path="/api/user/codes/list",
     *  operationId="list",
     * 	summary="Return a paginated list of all user's codes registered",
     * 	tags={"UserCodes"},
     * 	@OA\Response(
     *		response=200,
     *		description="A paginated list of all user's codes registered",
     *		@OA\JsonContent(
     *		    ref="#/components/schemas/UserCodeSchema",
     *           example={"response": {
     *              "data":{
     *                 "id": 1,
     *                 "key": "3caff61cb19d855503fe",
     *                 "max_uses": "5",
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
     *               "first_page_url": "/api/user/codes/list?page=1",
     *               "last_page_url": "/api/user/codes/list?page=1",
     *               "path": "/api/user/codes/list",
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
    public function list(  ) : object
    {
        return UserCode::where( 'is_active', true )->where( 'is_deleted', false )->paginate( 15 );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return object
     */
    /**
     * @OA\POST(
     * 	path="/api/user/codes",
     *  operationId="store",
     * 	summary="Create User Code Method",
     * 	tags={"UserCodes"},
     * @OA\Parameter(
     *      name="key",
     *      in="query",
     *      description="Write the key",
     *      required=false,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="max_uses",
     *      in="query",
     *      description="Write uses quantity",
     *      required=false,
     *      @OA\Schema(
     *          type="integer",
     *      ),
     *      style="form"
     *  ),
     *  @OA\Parameter(
     *      name="note",
     *      in="query",
     *      description="Write a description",
     *      required=false,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * 	@OA\Response(
     * 		response=201,
     *		description="Create User Code",
     *		@OA\JsonContent(
     *		    ref="#/components/schemas/UserCodeSchema",
     *          example={"response": {
     *              "data":{
     *                 "id": 1,
     *                 "key": "3caff61cb19d855503fe",
     *                 "max_uses": "5",
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
    public function store( Request $request ) : object
    {
        // Validate incoming request
        $this->validate( $request, [
            'key' => 'nullable|string|unique:user_codes',
            'max_uses' => 'nullable|numeric',
            'note' => 'nullable|string|max:250'
        ] );
        $current_time = new \DateTime(  );
        try {
            //
            $in_data = UserCode::create( [
                'key' => $request->input( 'key' ),
                'note' => $request->input( 'note' ),
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
     * @param int $key
     * @return object
     */
    /**
     * @OA\GET(
     * 	path="/api/user/codes/{key}",
     *  operationId="show",
     * 	summary="Show User Code",
     * 	tags={"UserCodes"},
     *  @OA\Parameter(
     *      name="key",
     *      in="path",
     *      description="Key",
     *      required=true,
     *      @OA\Schema(
     *          type="string",
     *          minimum=1
     *      ),
     *  ),
     * 	@OA\Response(
     *		response=200,
     *		description="Show User Code",
     *		@OA\JsonContent(
     *		    ref="#/components/schemas/UserCodeSchema",
     *          example={"response": {
     *              "data":{
     *                 "id": 1,
     *                 "key": "3caff61cb19d855503fe",*
     *                 "max_uses": "5",
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
    public function show( int $key ) : object
    {
        $data = UserCode::where( 'is_active', true )->where( 'is_deleted', false )->where( 'key', $key )->first(  );
        if ( !$data ) {
            return response(  )->json( [ 'message' => 'Código no encontrado, favor verificar que sea un código valido e intente nuevamente.' ], 404 );
        }

        return $data;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return object
     */
    /**
     * @OA\PUT(
     * 	path="/api/user/codes",
     *  operationId="update",
     * 	summary="Update User Code Method",
     * 	tags={"UserCodes"},
     * @OA\Parameter(
     *      name="id",
     *      in="path",
     *      description="Code ID",
     *      required=true,
     *      @OA\Schema(
     *          type="integer",
     *          format="int64",
     *          minimum=1
     *      ),
     * ),
     * @OA\Parameter(
     *      name="key",
     *      in="query",
     *      description="Write the key",
     *      required=false,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="max_uses",
     *      in="query",
     *      description="Write uses quantity",
     *      required=false,
     *      @OA\Schema(
     *          type="integer",
     *      ),
     *      style="form"
     *  ),
     *  @OA\Parameter(
     *      name="note",
     *      in="query",
     *      description="Write a description",
     *      required=false,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * 	@OA\Response(
     * 		response=201,
     *		description="Update User Code",
     *		@OA\JsonContent(
     *		    ref="#/components/schemas/UserCodeSchema",
     *          example={"response": {
     *              "data":{
     *                 "id": 1,
     *                 "key": "3caff61cb19d855503fe",
     *                 "max_uses": "5",
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
    public function update( int $id, Request $request ) : object
    {
        $data = UserCode::where( 'id', $id )->firstOrFail(  );
        // Validate incoming request
        $this->validate( $request, [
            'key' => 'nullable|string',
            'max_uses' => 'nullable|numeric',
            'note' => 'nullable|string|max:250'
        ] );

        $current_time = new \DateTime(  );
        try {

            $data->fill( [
                'key' => $request->input( 'key' ),
                'max_uses' => $request->input( 'max_uses' ),
                'note' => $request->input( 'note' ),
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
     * @param int $id
     * @return object
     */
    /**
     * @OA\DELETE(
     * 	path="/api/user/codes/{id}",
     *  operationId="destroy",
     * 	summary="Delete User Code",
     * 	tags={"UserCodes"},
     *  @OA\Parameter(
     *      name="id",
     *      in="path",
     *      description="Code ID",
     *      required=true,
     *      @OA\Schema(
     *          type="integer",
     *          format="int64",
     *          minimum=1
     *      ),
     *  ),
     * 	@OA\Response(
     *		response=200,
     *		description="Delete User Code",
     *		@OA\JsonContent(
     *		    ref="#/components/schemas/UserCodeSchema",
     *          example={"response": {
     *              "data":{
     *                 "id": 1,
     *                 "key": "3caff61cb19d855503fe",
     *                 "max_uses": "5",
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
    public function destroy( int $id ) : object
    {
        $data = UserCode::findOrFail( $id );
        $data->is_deleted = true;
        $data->save(  );

        return $data;
    }

    /**
     * @OA\POST(
     * 	path="/api/user/codes/search",
     *  operationId="search",
     * 	summary="Search a User Code",
     * 	tags={"UserCodes"},
     * @OA\Parameter(
     *      name="key",
     *      in="query",
     *      description="Write the Key",
     *      required=false,
     *      @OA\Schema(
     *          type="integer",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="max_uses",
     *      in="query",
     *      description="Write the Point's max uses",
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
     *		description="Search User Code",
     *		@OA\JsonContent(
     *		    ref="#/components/schemas/UserCodeSchema",
     *           example={"response": {
     *              "data":{
     *                 "id": 1,
     *                 "key": "3caff61cb19d855503fe",
     *                 "max_uses": "5",
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
     *               "first_page_url": "/api/user/codes/search?page=1",
     *               "last_page_url": "/api/user/codes/search?page=1",
     *               "path": "/api/user/codes/search",
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
            'key' => 'nullable|string|max:120',
            'max_uses' => 'nullable|numeric',
            'pagination' => 'nullable|number'
        ] );

        $points = UserCode::where( 'is_active', true )->where( 'is_deleted', false );
        if ( $request->key ) {
            $points->where( 'key', 'LIKE', "%{$request->key}%" );
        }
        if ( $request->max_uses ) {
            $points->where( 'max_uses', $request->max_uses );
        }
        if ( $request->paginate ) {
            return $points->orderBy( 'value', 'DESC' )->paginate( $request->paginate );
        }

        return $points->orderBy( 'created', 'ASC' )->get(  );
    }

}
