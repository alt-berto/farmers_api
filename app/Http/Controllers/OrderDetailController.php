<?php

namespace App\Http\Controllers;

use App\OrderDetail;
use App\InventoryPrice;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use App\Http\Controllers\Controller;

class OrderDetailController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\POST(
     * 	path="/api/order/details",
     *  operationId="store",
     * 	summary="Create Details Method",
     * 	tags={"OrderDetails"},
     * @OA\Parameter(
     *      name="order_id",
     *      in="query",
     *      description="Write the Order ID",
     *      required=true,
     *      @OA\Schema(
     *          type="integer",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="inventory_price_id",
     *      in="query",
     *      description="Write the Inventory Price ID",
     *      required=false,
     *      @OA\Schema(
     *          type="integer",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="quantity",
     *      in="query",
     *      description="Write the quantity",
     *      required=true,
     *      @OA\Schema(
     *          type="number",
     *      ),
     *      style="form"
     *  ),
     *  @OA\Parameter(
     *      name="note",
     *      in="query",
     *      description="Write Details's description",
     *      required=false,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * 	@OA\Response(
     * 		response=201,
     *		description="Create Details",
     *		@OA\JsonContent(
     *		    ref="#/components/schemas/OrderDetailSchema",
     *          example={"response": {
     *              "data":{
     *                 "id": 1,
     *                 "order_id": "1",
     *                 "inventory_price_id": "2",
     *                 "real_price": "30000.00",
     *                 "has_tax": "0.00",
     *                 "unit_measurement": null,
     *                 "quantity": "1",
     *                 "note": "TEST",
     *                 "is_active": "1",
     *                 "is_deleted": "0",
     *                 "created_at": "2021-07-09T00:00:21.000000Z",
     *                 "updated_at": "2021-07-09T00:00:21.000000Z",
     *                 "order": {
     *                     "id": 1,
     *                     "client_id": "1",
     *                     "card_info": null,
     *                     "card_name": null,
     *                     "last_digit_card": null,
     *                     "session": null,
     *                     "note": "TEST",
     *                     "state": "pending",
     *                     "is_deleted": "0",
     *                     "created_at": "2021-07-08T23:45:50.000000Z",
     *                     "updated_at": "2021-07-08T23:45:50.000000Z"
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
            'order_id' => 'required|numeric',
            'inventory_price_id' => 'required|numeric',
            'quantity' => 'required|numeric',
            'note' => 'nullable|string|max:250'
        ] );
        $current_time = new \DateTime(  );
        try {
            //
            $item = InventoryPrice::where( 'id', $request->inventory_price_id )->firstOrFail(  );
            $in_data = OrderDetail::create( [
                'order_id' => $request->input( 'order_id' ),
                'inventory_price_id' => $request->input( 'inventory_price_id' ),
                'real_price' => $item->price,
                'has_tax' => $item->has_tax,
                'quantity' => $request->input( 'quantity' ),
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
     * @param  \App\OrderDetail  $order_detail
     * @return \Illuminate\Http\Response
     */
    /**
	 * @OA\GET(
     * 	path="/api/order/{order_id}/details",
     *  operationId="show",
     * 	summary="Show Details",
	 * 	tags={"OrderDetails"},
     *  @OA\Parameter(
     *      name="order_id",
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
     *		description="Show Details",
     *		@OA\JsonContent(
     *		    ref="#/components/schemas/OrderDetailSchema",
     *          example={"response": {
     *              "data":{
     *                 "id": 1,
     *                 "order_id": "1",
     *                 "inventory_price_id": "2",
     *                 "real_price": "30000.00",
     *                 "has_tax": "0.00",
     *                 "unit_measurement": null,
     *                 "quantity": "1",
     *                 "note": "TEST",
     *                 "is_active": "1",
     *                 "is_deleted": "0",
     *                 "created_at": "2021-07-09T00:00:21.000000Z",
     *                 "updated_at": "2021-07-09T00:00:21.000000Z",
     *                 "order": {
     *                     "id": 1,
     *                     "client_id": "1",
     *                     "card_info": null,
     *                     "card_name": null,
     *                     "last_digit_card": null,
     *                     "session": null,
     *                     "note": "TEST",
     *                     "state": "pending",
     *                     "is_deleted": "0",
     *                     "created_at": "2021-07-08T23:45:50.000000Z",
     *                     "updated_at": "2021-07-08T23:45:50.000000Z"
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
    public function show( $order_id, Request $request )
    {
        //
        $data = OrderDetail::with( 'order' )->where( 'is_active', true )->where( 'is_deleted', false )->where( 'order_id', $order_id )->get(  );

		if ( $request->wantsJson(  ) ) {
			return $data;
            //return $data->toJson(  );
		}
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OrderDetail  $order_detail
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\PUT(
     * 	path="/api/order/details",
     *  operationId="update",
     * 	summary="Update Details Method",
     * 	tags={"OrderDetails"},
     * @OA\Parameter(
     *      name="id",
     *      in="path",
     *      description="Details ID",
     *      required=true,
     *      @OA\Schema(
     *          type="integer",
     *          format="int64",
     *          minimum=1
     *      ),
     * ),
     * @OA\Parameter(
     *      name="order_id",
     *      in="query",
     *      description="Write the Order ID",
     *      required=true,
     *      @OA\Schema(
     *          type="integer",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="inventory_price_id",
     *      in="query",
     *      description="Write the Inventory Price ID",
     *      required=false,
     *      @OA\Schema(
     *          type="integer",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="quantity",
     *      in="query",
     *      description="Write the quantity",
     *      required=true,
     *      @OA\Schema(
     *          type="number",
     *      ),
     *      style="form"
     *  ),
     *  @OA\Parameter(
     *      name="note",
     *      in="query",
     *      description="Write Details's description",
     *      required=false,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * 	@OA\Response(
     * 		response=201,
     *		description="Update Details",
     *		@OA\JsonContent(
     *		    ref="#/components/schemas/OrderDetailSchema",
     *          example={"response": {
     *              "data":{
     *                 "id": 1,
     *                 "order_id": "1",
     *                 "inventory_price_id": "2",
     *                 "real_price": "30000.00",
     *                 "has_tax": "0.00",
     *                 "unit_measurement": null,
     *                 "quantity": "1",
     *                 "note": "TEST",
     *                 "is_active": "1",
     *                 "is_deleted": "0",
     *                 "created_at": "2021-07-09T00:00:21.000000Z",
     *                 "updated_at": "2021-07-09T00:00:21.000000Z",
     *                 "order": {
     *                     "id": 1,
     *                     "client_id": "1",
     *                     "card_info": null,
     *                     "card_name": null,
     *                     "last_digit_card": null,
     *                     "session": null,
     *                     "note": "TEST",
     *                     "state": "pending",
     *                     "is_deleted": "0",
     *                     "created_at": "2021-07-08T23:45:50.000000Z",
     *                     "updated_at": "2021-07-08T23:45:50.000000Z"
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
        $data = OrderDetail::with( 'parent' )->where( 'id', $id )->firstOrFail(  );
        // Validate incoming request
        $this->validate( $request, [
            'order_id' => 'required|numeric',
            'inventory_price_id' => 'required|numeric',
            'quantity' => 'required|numeric',
            'note' => 'nullable|string|max:250'
        ] );
        $item = InventoryPrice::where( 'id', $request->inventory_price_id )->firstOrFail(  );
        $current_time = new \DateTime(  );
        try {

            $data->fill( [
                'order_id' => $request->input( 'order_id' ),
                'inventory_price_id' => $request->input( 'inventory_price_id' ),
                'real_price' => $item->price,
                'has_tax' => $item->has_tax,
                'quantity' => $request->input( 'quantity' ),
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
     * @param  \App\OrderDetail  $order_detail
     * @return \Illuminate\Http\Response
     */
    /**
	 * @OA\DELETE(
     * 	path="/api/order/details/{id}",
     *  operationId="destroy",
     * 	summary="Delete Details",
	 * 	tags={"OrderDetails"},
     *  @OA\Parameter(
     *      name="id",
     *      in="path",
     *      description="Details ID",
     *      required=true,
     *      @OA\Schema(
     *          type="integer",
     *          format="int64",
     *          minimum=1
     *      ),
     *  ),
	 * 	@OA\Response(
     *		response=200,
     *		description="Delete Details",
     *		@OA\JsonContent(
     *		    ref="#/components/schemas/OrderDetailSchema",
     *          example={"response": {
     *              "data":{
     *                 "id": 1,
     *                 "order_id": "1",
     *                 "inventory_price_id": "2",
     *                 "real_price": "30000.00",
     *                 "has_tax": "0.00",
     *                 "unit_measurement": null,
     *                 "quantity": "1",
     *                 "note": "TEST",
     *                 "is_active": "1",
     *                 "is_deleted": "0",
     *                 "created_at": "2021-07-09T00:00:21.000000Z",
     *                 "updated_at": "2021-07-09T00:00:21.000000Z",
     *                 "order": {
     *                     "id": 1,
     *                     "client_id": "1",
     *                     "card_info": null,
     *                     "card_name": null,
     *                     "last_digit_card": null,
     *                     "session": null,
     *                     "note": "TEST",
     *                     "state": "pending",
     *                     "is_deleted": "0",
     *                     "created_at": "2021-07-08T23:45:50.000000Z",
     *                     "updated_at": "2021-07-08T23:45:50.000000Z"
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
        $data = OrderDetail::with( 'parent' )->findOrFail( $id );
        $data->is_deleted = true;
        $data->save(  );

        if ( $request->wantsJson(  ) ) {
            return $data;
            //return $data->toJson(  );
        }
    }

}
