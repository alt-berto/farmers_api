<?php

namespace App\Http\Controllers;

use App\Point;
use App\RedeemableProduct;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use Barryvdh\DomPDF\Facade as PDF;

class PointController extends Controller
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
     * @OA\GET(
     * 	path="/api/points/generator/sku/{sku}/value/{value}/quantity/{quantity}",
     *  operationId="pdf_generator",
     * 	summary="Generate QRs",
     * 	tags={"Points"},
     *  @OA\Parameter(
     *      name="sku",
     *      in="path",
     *      description="Product SKU",
     *      required=true,
     *      @OA\Schema(
     *          type="string"
     *      ),
     *  ),
     *  @OA\Parameter(
     *      name="value",
     *      in="path",
     *      description="Point Value",
     *      required=true,
     *      @OA\Schema(
     *          type="number"
     *      ),
     *  ),
     *  @OA\Parameter(
     *      name="quantity",
     *      in="path",
     *      description="QR Quantity",
     *      required=true,
     *      @OA\Schema(
     *          type="string",
     *          minimum=1
     *      ),
     *  ),
     * 	@OA\Response(
     *		response=200,
     *		description="Generate QRs",
     *		@OA\JsonContent(
     *		    ref="#/components/schemas/PointSchema",
     *           example={"response": {
     *              "data":{
     *                 "id": 1,
     *                 "key": "3caff61cb19d855503fe",
     *                 "value": "1000.00",
     *                 "message": "Puntos promocionales exclusivos de...",
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
    public function pdf_generator( string $sku, ?int $value, int $quantity = 1 ) {
        $product = RedeemableProduct::where( 'sku', $sku )->firstOrFail();
        $items = array(  );
        $current_time = new \DateTime(  );
        for ( $i = 0; $i < $quantity; $i++ ) {
           $added = Point::create( [
               'key' => $this->random_string( 20 ),
               'sku' => $sku,
               'max_uses' => 1,
               'value' => $value ?? $product->value,
               'message' => "Puntos promocionales exclusivos",
               'note' => "Generador de QRs",
               'is_active' => true,
               'created' => $current_time->format( "Y-m-d H:i:s" ),
               'modified' => $current_time->format( "Y-m-d H:i:s" )
           ] );
            $items[] = $added;
        }
        $pdf = PDF::loadView( "pdfs.qr_list", compact( 'items', 'product' ) )->setPaper( 'a4', 'letter' );

        return $pdf->download( $product->name."_list.pdf" );
    }

    function random_string(int $size): string
    {
        $bytes = random_bytes($size / 2);
        return bin2hex($bytes);
    }

    /**
     * Display a listing of the resource.
     *
     * @return object
     */
    /**
	 * @OA\GET(
     * 	path="/api/points",
     *  operationId="index",
     * 	summary="Return all the points",
	 * 	tags={"Points"},
	 * 	@OA\Response(
     *		response=200,
     *		description="List of all the points registered",
     *		@OA\JsonContent(
     *		    ref="#/components/schemas/PointSchema",
     *           example={"response": {
     *              "data":{
     *                 "id": 1,
     *                 "key": "3caff61cb19d855503fe",
     *                 "value": "1000.00",
     *                 "message": "Puntos promocionales exclusivos de...",
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
        return Point::where( 'is_active', true )->where( 'is_deleted', false )->get(  );

    }

    /**
	 * @OA\GET(
     * 	path="/api/points/list/{user_id}",
     *  operationId="list",
     * 	summary="Return a paginated list of all the points registered",
	 * 	tags={"Points"},
     *  @OA\Parameter(
     *      name="user_id",
     *      in="path",
     *      description="User ID",
     *      required=true,
     *      @OA\Schema(
     *          type="integer",
     *          minimum=1
     *      ),
     *  ),
	 * 	@OA\Response(
     *		response=200,
     *		description="A paginated list of all the points registered",
     *		@OA\JsonContent(
     *		    ref="#/components/schemas/PointSchema",
     *           example={"response": {
     *              "data":{
     *                 "id": 1,
     *                 "key": "3caff61cb19d855503fe",
     *                 "value": "1000.00",
     *                 "message": "Puntos promocionales exclusivos de...",
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
     *               "first_page_url": "/api/points/list?page=1",
     *               "last_page_url": "/api/points/list?page=1",
     *               "path": "/api/points/list",
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
    public function list(int $user_id ) : object
    {
        return Point::with('users' )->where('is_active', true )->where('is_deleted', false )
            ->whereHas('users', function($query ) use ($user_id ) {
                return $query->where('user_id', $user_id );
            } )->paginate(15 );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return object
     */
    /**
     * @OA\POST(
     * 	path="/api/points",
     *  operationId="store",
     * 	summary="Create Point Method",
     * 	tags={"Points"},
     * @OA\Parameter(
     *      name="key",
     *      in="query",
     *      description="Write the point key",
     *      required=false,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="value",
     *      in="query",
     *      description="Write the point value",
     *      required=true,
     *      @OA\Schema(
     *          type="integer",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="message",
     *      in="query",
     *      description="Write the Point's message",
     *      required=false,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="max_uses",
     *      in="query",
     *      description="Write Point's uses quantity",
     *      required=false,
     *      @OA\Schema(
     *          type="integer",
     *      ),
     *      style="form"
     *  ),
     *  @OA\Parameter(
     *      name="note",
     *      in="query",
     *      description="Write Point's description",
     *      required=false,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * 	@OA\Response(
     * 		response=201,
     *		description="Create Point",
     *		@OA\JsonContent(
     *		    ref="#/components/schemas/PointSchema",
     *          example={"response": {
     *              "data":{
     *                 "id": 1,
     *                 "key": "3caff61cb19d855503fe",
     *                 "value": "1000.00",
     *                 "message": "Puntos promocionales exclusivos de...",
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
    public function store(Request $request) : object
    {
        // Validate incoming request
        $this->validate( $request, [
            'key' => 'nullable|string',
            'value' => 'required|numeric',
            'message' => 'nullable|string|max:200',
            'max_uses' => 'nullable|numeric',
            'note' => 'nullable|string|max:250'
        ] );
        $current_time = new \DateTime(  );
        try {
            //
            $in_data = Point::create( [
                'key' => $request->input( 'key' ),
                'value' => $request->input( 'value' ),
                'message' => $request->input( 'message' ),
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
     * @param string $point_key
     * @return object
     */
    /**
	 * @OA\GET(
     * 	path="/api/points/{point_key}",
     *  operationId="show",
     * 	summary="Show Point",
	 * 	tags={"Points"},
     *  @OA\Parameter(
     *      name="point_key",
     *      in="path",
     *      description="Point Key",
     *      required=true,
     *      @OA\Schema(
     *          type="string",
     *          minimum=1
     *      ),
     *  ),
	 * 	@OA\Response(
     *		response=200,
     *		description="Show Point",
     *		@OA\JsonContent(
     *		    ref="#/components/schemas/PointSchema",
     *          example={"response": {
     *              "data":{
     *                 "id": 1,
     *                 "key": "3caff61cb19d855503fe",
     *                 "value": "1000.00",
     *                 "message": "Puntos promocionales exclusivos de...",
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
    public function show( string $point_key ) : object
    {
        $data = Point::where( 'is_active', true )->where( 'is_deleted', false )->where( 'key', $point_key )->first(  );
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
     * 	path="/api/points",
     *  operationId="update",
     * 	summary="Update Point Method",
     * 	tags={"Points"},
     * @OA\Parameter(
     *      name="id",
     *      in="path",
     *      description="Point ID",
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
     *      description="Write the point key",
     *      required=false,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="value",
     *      in="query",
     *      description="Write the point value",
     *      required=true,
     *      @OA\Schema(
     *          type="integer",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="message",
     *      in="query",
     *      description="Write the Point's message",
     *      required=false,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="max_uses",
     *      in="query",
     *      description="Write Point's uses quantity",
     *      required=false,
     *      @OA\Schema(
     *          type="integer",
     *      ),
     *      style="form"
     *  ),
     *  @OA\Parameter(
     *      name="note",
     *      in="query",
     *      description="Write Point's description",
     *      required=false,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * 	@OA\Response(
     * 		response=201,
     *		description="Update Point",
     *		@OA\JsonContent(
     *		    ref="#/components/schemas/PointSchema",
     *          example={"response": {
     *              "data":{
     *                 "id": 1,
     *                 "key": "3caff61cb19d855503fe",
     *                 "value": "1000.00",
     *                 "message": "Puntos promocionales exclusivos de...",
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
        $data = Point::where( 'id', $id )->firstOrFail(  );
        // Validate incoming request
        $this->validate( $request, [
            'key' => 'nullable|string',
            'value' => 'required|numeric',
            'message' => 'nullable|string|max:200',
            'max_uses' => 'nullable|numeric',
            'note' => 'nullable|string|max:250'
        ] );

        $current_time = new \DateTime(  );
        try {
            $data->fill( [
                'key' => $request->input( 'key' ),
                'value' => $request->input( 'value' ),
                'message' => $request->input( 'message' ),
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
     * 	path="/api/points/{id}",
     *  operationId="destroy",
     * 	summary="Delete Point",
	 * 	tags={"Points"},
     *  @OA\Parameter(
     *      name="id",
     *      in="path",
     *      description="Point ID",
     *      required=true,
     *      @OA\Schema(
     *          type="integer",
     *          format="int64",
     *          minimum=1
     *      ),
     *  ),
	 * 	@OA\Response(
     *		response=200,
     *		description="Delete Point",
     *		@OA\JsonContent(
     *		    ref="#/components/schemas/PointSchema",
     *          example={"response": {
     *              "data":{
     *                 "id": 1,
     *                 "key": "3caff61cb19d855503fe",
     *                 "value": "1000.00",
     *                 "message": "Puntos promocionales exclusivos de...",
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
        $data = Point::findOrFail( $id );
        $data->is_deleted = true;
        $data->save(  );

        return $data;
    }

    /**
	 * @OA\POST(
     * 	path="/api/points/search",
     *  operationId="search",
     * 	summary="Search a Point",
	 * 	tags={"Points"},
     * @OA\Parameter(
     *      name="key",
     *      in="query",
     *      description="Write the Point Key",
     *      required=false,
     *      @OA\Schema(
     *          type="integer",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="value",
     *      in="query",
     *      description="Write the Point value",
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
     *		description="Search points",
     *		@OA\JsonContent(
     *		    ref="#/components/schemas/PointSchema",
     *           example={"response": {
     *              "data":{
     *                 "id": 1,
     *                 "key": "3caff61cb19d855503fe",
     *                 "value": "1000.00",
     *                 "message": "Puntos promocionales exclusivos de...",
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
     *               "first_page_url": "/api/points/search?page=1",
     *               "last_page_url": "/api/points/search?page=1",
     *               "path": "/api/points/search",
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
    public function search( Request $request ) : object
    {
        $this->validate( $request, [
            'key' => 'nullable|string|max:120',
            'value' => 'nullable|numeric',
            'max_uses' => 'nullable|numeric',
            'pagination' => 'nullable|number'
        ] );

        $points = Point::where( 'is_active', true )->where( 'is_deleted', false );
        if ( $request->key ) {
            $points->where( 'key', 'LIKE', "%{$request->key}%" );
        }
        if ( $request->value ) {
            $points->where( 'value', $request->value );
        }
        if ( $request->max_uses ) {
            $points->where( 'max_uses', $request->max_uses );
        }
        if ( $request->paginate ) {
            return $points->orderBy( 'value', 'DESC' )->paginate( $request->paginate );
        }

        return $points->orderBy( 'value', 'DESC' )->get(  );
    }

}
