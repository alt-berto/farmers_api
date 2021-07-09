<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use App\Http\Controllers\Controller;

class OrderController extends Controller
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
     * 	path="/api/orders",
     *  operationId="index",
     * 	summary="Return all the orders",
	 * 	tags={"Orders"},
	 * 	@OA\Response(
     *		response=200,
     *		description="List of all the orders registered",
     *		@OA\JsonContent(
     *		    ref="#/components/schemas/OrderSchema",
     *           example={"response": {
     *              "data":{
     *                 "id": 1,
     *                 "client_id": "1",
     *                 "card_info": null,
     *                 "card_name": null,
     *                 "last_digit_card": null,
     *                 "session": null,
     *                 "note": "TEST",
     *                 "state": "pending",
     *                 "is_deleted": "0",
     *                 "created_at": "2021-07-08T23:45:50.000000Z",
     *                 "updated_at": "2021-07-08T23:45:50.000000Z",
     *                 "details": {
     *                         "id": 1,
     *                         "order_id": "1",
     *                         "inventory_price_id": "2",
     *                         "real_price": "30000.00",
     *                         "has_tax": "0.00",
     *                         "unit_measurement": null,
     *                         "quantity": "1",
     *                         "note": "TEST",
     *                         "is_active": "1",
     *                         "is_deleted": "0",
     *                         "created_at": "2021-07-09T00:00:21.000000Z",
     *                         "updated_at": "2021-07-09T00:00:21.000000Z",
     *                         "inventory_price": {
     *                             "id": 2,
     *                             "inventory_id": "2",
     *                             "price": "30000.00",
     *                             "has_tax": "0.00",
     *                             "note": "Pre-Registro",
     *                             "is_active": "1",
     *                             "is_deleted": "0",
     *                             "created_at": "2021-06-30T00:21:57.000000Z",
     *                             "updated_at": "2021-06-30T00:21:57.000000Z",
     *                             "inventory": {
     *                                 "id": 2,
     *                                 "product_id": "1",
     *                                 "point_id": null,
     *                                 "company_id": null,
     *                                 "name": "iMac 2021",
     *                                 "description": "* Sumersiva pantalla Retina de 24 pulgadas 4.5 K con amplia gama de colores P3 y 500 nits de brillo.<br/>* El chip Apple M1 ofrece un potente rendimiento con CPU de 8 núcleos y GPU de 7 núcleos.<br/* Diseño increíblemente delgado de 0.453 in en colores vi",
     *                                 "include": null,
     *                                 "company_name": "Apple",
     *                                 "image": "imac.webp",
     *                                 "classification": "",
     *                                 "code": null,
     *                                 "unit_measurement": "Unid",
     *                                 "qmin": "10",
     *                                 "qmax": "50",
     *                                 "existence": "10",
     *                                 "availability": "10",
     *                                 "note": "Pre-Registro",
     *                                 "is_active": "1",
     *                                 "is_deleted": "0",
     *                                 "created_at": "2021-06-30T00:21:57.000000Z",
     *                                 "updated_at": "2021-06-30T00:21:57.000000Z"
     *                             }
     *                         }
     *                      },
     *                 },
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
        $data = Order::with( 'details.inventory_price.inventory' )->where( 'is_deleted', false )->get(  );
		if ( $request->wantsJson(  ) ) {
			return $data;
            //return $data->toJson(  );
		}
    }

    /**
	 * @OA\GET(
     * 	path="/api/orders/list",
     *  operationId="list",
     * 	summary="Return a paginated list of all the orders registered",
	 * 	tags={"Orders"},
	 * 	@OA\Response(
     *		response=200,
     *		description="A paginated list of all the orders registered",
     *		@OA\JsonContent(
     *		    ref="#/components/schemas/OrderSchema",
     *           example={"response": {
     *              "data":{
     *                 "id": 1,
     *                 "client_id": "1",
     *                 "card_info": null,
     *                 "card_name": null,
     *                 "last_digit_card": null,
     *                 "session": null,
     *                 "note": "TEST",
     *                 "state": "pending",
     *                 "is_deleted": "0",
     *                 "created_at": "2021-07-08T23:45:50.000000Z",
     *                 "updated_at": "2021-07-08T23:45:50.000000Z",
     *                 "details": {
     *                         "id": 1,
     *                         "order_id": "1",
     *                         "inventory_price_id": "2",
     *                         "real_price": "30000.00",
     *                         "has_tax": "0.00",
     *                         "unit_measurement": null,
     *                         "quantity": "1",
     *                         "note": "TEST",
     *                         "is_active": "1",
     *                         "is_deleted": "0",
     *                         "created_at": "2021-07-09T00:00:21.000000Z",
     *                         "updated_at": "2021-07-09T00:00:21.000000Z",
     *                         "inventory_price": {
     *                             "id": 2,
     *                             "inventory_id": "2",
     *                             "price": "30000.00",
     *                             "has_tax": "0.00",
     *                             "note": "Pre-Registro",
     *                             "is_active": "1",
     *                             "is_deleted": "0",
     *                             "created_at": "2021-06-30T00:21:57.000000Z",
     *                             "updated_at": "2021-06-30T00:21:57.000000Z",
     *                             "inventory": {
     *                                 "id": 2,
     *                                 "product_id": "1",
     *                                 "point_id": null,
     *                                 "company_id": null,
     *                                 "name": "iMac 2021",
     *                                 "description": "* Sumersiva pantalla Retina de 24 pulgadas 4.5 K con amplia gama de colores P3 y 500 nits de brillo.<br/>* El chip Apple M1 ofrece un potente rendimiento con CPU de 8 núcleos y GPU de 7 núcleos.<br/* Diseño increíblemente delgado de 0.453 in en colores vi",
     *                                 "include": null,
     *                                 "company_name": "Apple",
     *                                 "image": "imac.webp",
     *                                 "classification": "",
     *                                 "code": null,
     *                                 "unit_measurement": "Unid",
     *                                 "qmin": "10",
     *                                 "qmax": "50",
     *                                 "existence": "10",
     *                                 "availability": "10",
     *                                 "note": "Pre-Registro",
     *                                 "is_active": "1",
     *                                 "is_deleted": "0",
     *                                 "created_at": "2021-06-30T00:21:57.000000Z",
     *                                 "updated_at": "2021-06-30T00:21:57.000000Z"
     *                             }
     *                         }
     *                      },
     *                 },
     *               "current_page": 1,
     *               "from": 1,
     *               "last_page": 1,
     *               "per_page": 15,
     *               "to": 1,
     *               "total": 1,
     *               "first_page_url": "/api/orders/list?page=1",
     *               "last_page_url": "/api/orders/list?page=1",
     *               "path": "/api/orders/list",
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
        $data = Order::with( 'details.inventory_price.inventory' )->where( 'is_deleted', false )->paginate( 15 );

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
     * 	path="/api/orders",
     *  operationId="store",
     * 	summary="Create Order Method, The order's states: 'pending' (by default), 'done', 'canceled' ",
     * 	tags={"Orders"},
     * @OA\Parameter(
     *      name="client_id",
     *      in="query",
     *      description="Write the user ID",
     *      required=true,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="session",
     *      in="query",
     *      description="Write the session code",
     *      required=false,
     *      @OA\Schema(
     *          type="integer",
     *      ),
     *      style="form"
     *  ),
     *  @OA\Parameter(
     *      name="note",
     *      in="query",
     *      description="Write Order's description",
     *      required=false,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * 	@OA\Response(
     * 		response=201,
     *		description="Create Order",
     *		@OA\JsonContent(
     *		    ref="#/components/schemas/OrderSchema",
     *          example={"response": {
     *              "data":{
     *                 "id": 1,
     *                 "client_id": "1",
     *                 "card_info": null,
     *                 "card_name": null,
     *                 "last_digit_card": null,
     *                 "session": null,
     *                 "note": "TEST",
     *                 "state": "pending",
     *                 "is_deleted": "0",
     *                 "created_at": "2021-07-08T23:45:50.000000Z",
     *                 "updated_at": "2021-07-08T23:45:50.000000Z",
     *                 "details": {
     *                         "id": 1,
     *                         "order_id": "1",
     *                         "inventory_price_id": "2",
     *                         "real_price": "30000.00",
     *                         "has_tax": "0.00",
     *                         "unit_measurement": null,
     *                         "quantity": "1",
     *                         "note": "TEST",
     *                         "is_active": "1",
     *                         "is_deleted": "0",
     *                         "created_at": "2021-07-09T00:00:21.000000Z",
     *                         "updated_at": "2021-07-09T00:00:21.000000Z",
     *                         "inventory_price": {
     *                             "id": 2,
     *                             "inventory_id": "2",
     *                             "price": "30000.00",
     *                             "has_tax": "0.00",
     *                             "note": "Pre-Registro",
     *                             "is_active": "1",
     *                             "is_deleted": "0",
     *                             "created_at": "2021-06-30T00:21:57.000000Z",
     *                             "updated_at": "2021-06-30T00:21:57.000000Z",
     *                             "inventory": {
     *                                 "id": 2,
     *                                 "product_id": "1",
     *                                 "point_id": null,
     *                                 "company_id": null,
     *                                 "name": "iMac 2021",
     *                                 "description": "* Sumersiva pantalla Retina de 24 pulgadas 4.5 K con amplia gama de colores P3 y 500 nits de brillo.<br/>* El chip Apple M1 ofrece un potente rendimiento con CPU de 8 núcleos y GPU de 7 núcleos.<br/* Diseño increíblemente delgado de 0.453 in en colores vi",
     *                                 "include": null,
     *                                 "company_name": "Apple",
     *                                 "image": "imac.webp",
     *                                 "classification": "",
     *                                 "code": null,
     *                                 "unit_measurement": "Unid",
     *                                 "qmin": "10",
     *                                 "qmax": "50",
     *                                 "existence": "10",
     *                                 "availability": "10",
     *                                 "note": "Pre-Registro",
     *                                 "is_active": "1",
     *                                 "is_deleted": "0",
     *                                 "created_at": "2021-06-30T00:21:57.000000Z",
     *                                 "updated_at": "2021-06-30T00:21:57.000000Z"
     *                             }
     *                         }
     *                      },
     *                 },
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
            'client_id' => 'required|numeric',
            'note' => 'nullable|string|max:250'
        ] );
        $current_time = new \DateTime(  );
        try {
            //
            $in_data = Order::create( [
                'client_id' => $request->input( 'client_id' ),
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
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    /**
	 * @OA\GET(
     * 	path="/api/orders/{id}",
     *  operationId="show",
     * 	summary="Show Order",
	 * 	tags={"Orders"},
     *  @OA\Parameter(
     *      name="id",
     *      in="path",
     *      description="Order ID",
     *      required=true,
     *      @OA\Schema(
     *          type="integer",
     *          format="int64",
     *          minimum=1
     *      ),
     *  ),
	 * 	@OA\Response(
     *		response=200,
     *		description="Show Order",
     *		@OA\JsonContent(
     *		    ref="#/components/schemas/OrderSchema",
     *          example={"response": {
     *              "data":{
     *                 "id": 1,
     *                 "client_id": "1",
     *                 "card_info": null,
     *                 "card_name": null,
     *                 "last_digit_card": null,
     *                 "session": null,
     *                 "note": "TEST",
     *                 "state": "pending",
     *                 "is_deleted": "0",
     *                 "created_at": "2021-07-08T23:45:50.000000Z",
     *                 "updated_at": "2021-07-08T23:45:50.000000Z",
     *                 "details": {
     *                         "id": 1,
     *                         "order_id": "1",
     *                         "inventory_price_id": "2",
     *                         "real_price": "30000.00",
     *                         "has_tax": "0.00",
     *                         "unit_measurement": null,
     *                         "quantity": "1",
     *                         "note": "TEST",
     *                         "is_active": "1",
     *                         "is_deleted": "0",
     *                         "created_at": "2021-07-09T00:00:21.000000Z",
     *                         "updated_at": "2021-07-09T00:00:21.000000Z",
     *                         "inventory_price": {
     *                             "id": 2,
     *                             "inventory_id": "2",
     *                             "price": "30000.00",
     *                             "has_tax": "0.00",
     *                             "note": "Pre-Registro",
     *                             "is_active": "1",
     *                             "is_deleted": "0",
     *                             "created_at": "2021-06-30T00:21:57.000000Z",
     *                             "updated_at": "2021-06-30T00:21:57.000000Z",
     *                             "inventory": {
     *                                 "id": 2,
     *                                 "product_id": "1",
     *                                 "point_id": null,
     *                                 "company_id": null,
     *                                 "name": "iMac 2021",
     *                                 "description": "* Sumersiva pantalla Retina de 24 pulgadas 4.5 K con amplia gama de colores P3 y 500 nits de brillo.<br/>* El chip Apple M1 ofrece un potente rendimiento con CPU de 8 núcleos y GPU de 7 núcleos.<br/* Diseño increíblemente delgado de 0.453 in en colores vi",
     *                                 "include": null,
     *                                 "company_name": "Apple",
     *                                 "image": "imac.webp",
     *                                 "classification": "",
     *                                 "code": null,
     *                                 "unit_measurement": "Unid",
     *                                 "qmin": "10",
     *                                 "qmax": "50",
     *                                 "existence": "10",
     *                                 "availability": "10",
     *                                 "note": "Pre-Registro",
     *                                 "is_active": "1",
     *                                 "is_deleted": "0",
     *                                 "created_at": "2021-06-30T00:21:57.000000Z",
     *                                 "updated_at": "2021-06-30T00:21:57.000000Z"
     *                             }
     *                         }
     *                      },
     *                 },
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
        $data = Order::with( 'details.inventory_price.inventory' )->where( 'is_deleted', false )->where( 'id', $id )->firstOrFail(  );

		if ( $request->wantsJson(  ) ) {
			return $data;
            //return $data->toJson(  );
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    /**
	 * @OA\GET(
     * 	path="/api/user/orders/{user_id}",
     *  operationId="user_orders",
     * 	summary="Show Order",
	 * 	tags={"Orders"},
     *  @OA\Parameter(
     *      name="user_id",
     *      in="path",
     *      description="Usser ID",
     *      required=true,
     *      @OA\Schema(
     *          type="integer",
     *          format="int64",
     *          minimum=1
     *      ),
     *  ),
	 * 	@OA\Response(
     *		response=200,
     *		description="Show Order",
     *		@OA\JsonContent(
     *		    ref="#/components/schemas/OrderSchema",
     *          example={"response": {
     *              "data":{
     *                 "id": 1,
     *                 "client_id": "1",
     *                 "card_info": null,
     *                 "card_name": null,
     *                 "last_digit_card": null,
     *                 "session": null,
     *                 "note": "TEST",
     *                 "state": "pending",
     *                 "is_deleted": "0",
     *                 "created_at": "2021-07-08T23:45:50.000000Z",
     *                 "updated_at": "2021-07-08T23:45:50.000000Z",
     *                 "details": {
     *                         "id": 1,
     *                         "order_id": "1",
     *                         "inventory_price_id": "2",
     *                         "real_price": "30000.00",
     *                         "has_tax": "0.00",
     *                         "unit_measurement": null,
     *                         "quantity": "1",
     *                         "note": "TEST",
     *                         "is_active": "1",
     *                         "is_deleted": "0",
     *                         "created_at": "2021-07-09T00:00:21.000000Z",
     *                         "updated_at": "2021-07-09T00:00:21.000000Z",
     *                         "inventory_price": {
     *                             "id": 2,
     *                             "inventory_id": "2",
     *                             "price": "30000.00",
     *                             "has_tax": "0.00",
     *                             "note": "Pre-Registro",
     *                             "is_active": "1",
     *                             "is_deleted": "0",
     *                             "created_at": "2021-06-30T00:21:57.000000Z",
     *                             "updated_at": "2021-06-30T00:21:57.000000Z",
     *                             "inventory": {
     *                                 "id": 2,
     *                                 "product_id": "1",
     *                                 "point_id": null,
     *                                 "company_id": null,
     *                                 "name": "iMac 2021",
     *                                 "description": "* Sumersiva pantalla Retina de 24 pulgadas 4.5 K con amplia gama de colores P3 y 500 nits de brillo.<br/>* El chip Apple M1 ofrece un potente rendimiento con CPU de 8 núcleos y GPU de 7 núcleos.<br/* Diseño increíblemente delgado de 0.453 in en colores vi",
     *                                 "include": null,
     *                                 "company_name": "Apple",
     *                                 "image": "imac.webp",
     *                                 "classification": "",
     *                                 "code": null,
     *                                 "unit_measurement": "Unid",
     *                                 "qmin": "10",
     *                                 "qmax": "50",
     *                                 "existence": "10",
     *                                 "availability": "10",
     *                                 "note": "Pre-Registro",
     *                                 "is_active": "1",
     *                                 "is_deleted": "0",
     *                                 "created_at": "2021-06-30T00:21:57.000000Z",
     *                                 "updated_at": "2021-06-30T00:21:57.000000Z"
     *                             }
     *                         }
     *                      },
     *                 },
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
    public function user_orders( $user_id, Request $request )
    {
        //
        $data = Order::with( 'details.inventory_price.inventory' )->where( 'is_deleted', false )->where( 'client_id', $user_id )->get(  );

		if ( $request->wantsJson(  ) ) {
			return $data;
            //return $data->toJson(  );
		}
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\PUT(
     * 	path="/api/orders",
     *  operationId="update",
     * 	summary="Update Order Method, The order's states: 'pending' (by default), 'done', 'canceled'",
     * 	tags={"Orders"},
     * @OA\Parameter(
     *      name="id",
     *      in="path",
     *      description="Order ID",
     *      required=true,
     *      @OA\Schema(
     *          type="integer",
     *          format="int64",
     *          minimum=1
     *      ),
     * ),
     * @OA\Parameter(
     *      name="client_id",
     *      in="query",
     *      description="Write the user ID",
     *      required=true,
     *      @OA\Schema(
     *          type="integer",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="state",
     *      in="query",
     *      description="Write the order's state (pending, done, canceled)",
     *      required=true,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     *  @OA\Parameter(
     *      name="note",
     *      in="query",
     *      description="Write Order's description",
     *      required=false,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * 	@OA\Response(
     * 		response=201,
     *		description="Update Order",
     *		@OA\JsonContent(
     *		    ref="#/components/schemas/OrderSchema",
     *          example={"response": {
     *              "data":{
     *                 "id": 1,
     *                 "client_id": "1",
     *                 "card_info": null,
     *                 "card_name": null,
     *                 "last_digit_card": null,
     *                 "session": null,
     *                 "note": "TEST",
     *                 "state": "pending",
     *                 "is_deleted": "0",
     *                 "created_at": "2021-07-08T23:45:50.000000Z",
     *                 "updated_at": "2021-07-08T23:45:50.000000Z",
     *                 "details": {
     *                         "id": 1,
     *                         "order_id": "1",
     *                         "inventory_price_id": "2",
     *                         "real_price": "30000.00",
     *                         "has_tax": "0.00",
     *                         "unit_measurement": null,
     *                         "quantity": "1",
     *                         "note": "TEST",
     *                         "is_active": "1",
     *                         "is_deleted": "0",
     *                         "created_at": "2021-07-09T00:00:21.000000Z",
     *                         "updated_at": "2021-07-09T00:00:21.000000Z",
     *                         "inventory_price": {
     *                             "id": 2,
     *                             "inventory_id": "2",
     *                             "price": "30000.00",
     *                             "has_tax": "0.00",
     *                             "note": "Pre-Registro",
     *                             "is_active": "1",
     *                             "is_deleted": "0",
     *                             "created_at": "2021-06-30T00:21:57.000000Z",
     *                             "updated_at": "2021-06-30T00:21:57.000000Z",
     *                             "inventory": {
     *                                 "id": 2,
     *                                 "product_id": "1",
     *                                 "point_id": null,
     *                                 "company_id": null,
     *                                 "name": "iMac 2021",
     *                                 "description": "* Sumersiva pantalla Retina de 24 pulgadas 4.5 K con amplia gama de colores P3 y 500 nits de brillo.<br/>* El chip Apple M1 ofrece un potente rendimiento con CPU de 8 núcleos y GPU de 7 núcleos.<br/* Diseño increíblemente delgado de 0.453 in en colores vi",
     *                                 "include": null,
     *                                 "company_name": "Apple",
     *                                 "image": "imac.webp",
     *                                 "classification": "",
     *                                 "code": null,
     *                                 "unit_measurement": "Unid",
     *                                 "qmin": "10",
     *                                 "qmax": "50",
     *                                 "existence": "10",
     *                                 "availability": "10",
     *                                 "note": "Pre-Registro",
     *                                 "is_active": "1",
     *                                 "is_deleted": "0",
     *                                 "created_at": "2021-06-30T00:21:57.000000Z",
     *                                 "updated_at": "2021-06-30T00:21:57.000000Z"
     *                             }
     *                         }
     *                      },
     *                 },
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
        $data = Order::with( 'details.inventory_price.inventory' )->where( 'id', $id )->firstOrFail(  );
        // Validate incoming request
        $this->validate( $request, [
            'client_id' => 'required|numeric',
            'state' => 'required|string|max:50',
            'note' => 'nullable|string|max:250'
        ] );

        $current_time = new \DateTime(  );
        try {

            $data->fill( [
                'client_id' => $request->input( 'client_id' ),
                'state' => $request->input( 'state' ),
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
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    /**
	 * @OA\DELETE(
     * 	path="/api/orders/{id}",
     *  operationId="destroy",
     * 	summary="Delete Order",
	 * 	tags={"Orders"},
     *  @OA\Parameter(
     *      name="id",
     *      in="path",
     *      description="Order ID",
     *      required=true,
     *      @OA\Schema(
     *          type="integer",
     *          format="int64",
     *          minimum=1
     *      ),
     *  ),
	 * 	@OA\Response(
     *		response=200,
     *		description="Delete Order",
     *		@OA\JsonContent(
     *		    ref="#/components/schemas/OrderSchema",
     *          example={"response": {
     *              "data":{
     *                 "id": 1,
     *                 "client_id": "1",
     *                 "card_info": null,
     *                 "card_name": null,
     *                 "last_digit_card": null,
     *                 "session": null,
     *                 "note": "TEST",
     *                 "state": "pending",
     *                 "is_deleted": "0",
     *                 "created_at": "2021-07-08T23:45:50.000000Z",
     *                 "updated_at": "2021-07-08T23:45:50.000000Z",
     *                 "details": {
     *                         "id": 1,
     *                         "order_id": "1",
     *                         "inventory_price_id": "2",
     *                         "real_price": "30000.00",
     *                         "has_tax": "0.00",
     *                         "unit_measurement": null,
     *                         "quantity": "1",
     *                         "note": "TEST",
     *                         "is_active": "1",
     *                         "is_deleted": "0",
     *                         "created_at": "2021-07-09T00:00:21.000000Z",
     *                         "updated_at": "2021-07-09T00:00:21.000000Z",
     *                         "inventory_price": {
     *                             "id": 2,
     *                             "inventory_id": "2",
     *                             "price": "30000.00",
     *                             "has_tax": "0.00",
     *                             "note": "Pre-Registro",
     *                             "is_active": "1",
     *                             "is_deleted": "0",
     *                             "created_at": "2021-06-30T00:21:57.000000Z",
     *                             "updated_at": "2021-06-30T00:21:57.000000Z",
     *                             "inventory": {
     *                                 "id": 2,
     *                                 "product_id": "1",
     *                                 "point_id": null,
     *                                 "company_id": null,
     *                                 "name": "iMac 2021",
     *                                 "description": "* Sumersiva pantalla Retina de 24 pulgadas 4.5 K con amplia gama de colores P3 y 500 nits de brillo.<br/>* El chip Apple M1 ofrece un potente rendimiento con CPU de 8 núcleos y GPU de 7 núcleos.<br/* Diseño increíblemente delgado de 0.453 in en colores vi",
     *                                 "include": null,
     *                                 "company_name": "Apple",
     *                                 "image": "imac.webp",
     *                                 "classification": "",
     *                                 "code": null,
     *                                 "unit_measurement": "Unid",
     *                                 "qmin": "10",
     *                                 "qmax": "50",
     *                                 "existence": "10",
     *                                 "availability": "10",
     *                                 "note": "Pre-Registro",
     *                                 "is_active": "1",
     *                                 "is_deleted": "0",
     *                                 "created_at": "2021-06-30T00:21:57.000000Z",
     *                                 "updated_at": "2021-06-30T00:21:57.000000Z"
     *                             }
     *                         }
     *                      },
     *                 },
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
        $data = Order::with( 'details.inventory_price.inventory' )->findOrFail( $id );
        $data->is_deleted = true;
        $data->save(  );

        if ( $request->wantsJson(  ) ) {
            return $data;
            //return $data->toJson(  );
        }
    }



}
