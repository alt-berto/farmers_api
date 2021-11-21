<?php

namespace App\Http\Controllers;

use App\Point;
use App\Order;
use App\UserPoint;
use App\RedeemableProduct;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;

class UserPointController extends Controller
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
     * @param Request $request
     * @return object
     */
    /**
     * @OA\POST(
     * 	path="/api/user/points",
     *  operationId="store",
     * 	summary="Create User Point Method",
     * 	tags={"UserPoints"},
     * @OA\Parameter(
     *      name="user_id",
     *      in="query",
     *      description="Write the User ID",
     *      required=true,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="point_key",
     *      in="query",
     *      description="Write the point key",
     *      required=true,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     *  @OA\Parameter(
     *      name="note",
     *      in="query",
     *      description="Write User Point's description",
     *      required=false,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * 	@OA\Response(
     * 		response=201,
     *		description="Create User Point",
     *		@OA\JsonContent(
     *		    ref="#/components/schemas/UserPointSchema",
     *          example={"response": {
     *              "data":{
     *                 "id": 1,
     *                 "user_id": "1",
     *                 "point_id": "3",
     *                 "note": "Pre-Registro",
     *                 "is_active": "1",
     *                 "is_deleted": "0",
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
     *         response=404,
     *         description="Código no encontrado, favor verificar que sea un código valido e intente nuevamente."
     *  ),
     * @OA\Response(
     *         response=200,
     *         description="El código ya ha sido canjeado # veces, intente con otro código."
     *  ),
     * @OA\Response(
     *         response=204,
     *         description="Ud ya ha canjeado este código."
     *  ),
     * @OA\Response(
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
            'user_id' => 'required|numeric',
            'point_key' => 'required|string|max:150',
            'note' => 'nullable|string|max:250'
        ] );
        $point = Point::with('redeemable_product')->where( 'is_active', true )->where( 'is_deleted', false )->where( 'key', $request->point_key )->first(  );
        if ( !$point ) {
            return response(  )->json( [ 'message' => 'Código no encontrado, favor verificar que sea un código valido e intente nuevamente.' ], 404 );
        }
        $check_points = UserPoint::where( 'is_active', true )->where( 'point_id', $point->id )->get(  );
        if ( count( $check_points ) >= $point->max_uses ) {
            return response(  )->json( [ 'message' => 'El código ya ha sido canjeado '.$point->max_uses.' veces, intente con otro código.' ], 404 );
        }
        if (  count( $check_points ) > 0 ) {
            foreach ( $check_points as $value ) {
                if ( (int) $value->user_id === (int) $request->user_id ) {
                    return response(  )->json( [ 'message' => 'Ud ya ha canjeado este código' ], 404 );
                }
            }
        }
        $current_time = new \DateTime(  );
        try {
            //
            $in_data = UserPoint::create( [
                'user_id' => $request->input( 'user_id' ),
                'point_id' => $point->id,
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
     * @param int $user_id
     * @return object
     */
    /**
	 * @OA\GET(
     * 	path="/api/user/points/{user_id}",
     *  operationId="show",
     * 	summary="Show User Point",
	 * 	tags={"UserPoints"},
     *  @OA\Parameter(
     *      name="user_id",
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
     *		description="Show User Point",
     *		@OA\JsonContent(
     *		    ref="#/components/schemas/UserPointSchema",
     *          example={"response": {
     *              "data":{
     *                 "id": 1,
     *                 "user_id": "1",
     *                 "point_id": "3",
     *                 "note": "Pre-Registro",
     *                 "is_active": "1",
     *                 "is_deleted": "0",
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
    public function show( int $user_id ) : object
    {
        return UserPoint::with( [ 'user', 'point.redeemable_product' ] )->where( 'is_active', true )->where( 'is_deleted', false )->where( 'user_id', $user_id )->get(  );
    }

    /**
     * Display the specified resource.
     *
     * @param int $user_id
     * @return object
     */
    /**
	 * @OA\GET(
     * 	path="/api/user/points/{user_id}/count",
     *  operationId="count_points",
     * 	summary="Show User Totals Point",
	 * 	tags={"UserPoints"},
     *  @OA\Parameter(
     *      name="user_id",
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
     *		description="Show User Point",
     *		@OA\JsonContent(
     *		    ref="#/components/schemas/UserPointSchema",
     *          example={"response": {
     *              "data":{
     *                 "points": 5000,
     *                 "orders": 1000,
     *                 "total": 4000,
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
    public function count_points( int $user_id ) : array
    {
        $data_points = UserPoint::with( 'point.redeemable_product' )->where( 'is_active', true )->where( 'is_deleted', false )->where( 'user_id', $user_id )->get(  );
        $data_orders = Order::with( 'details.inventory_price' )->where( 'state', 'done' )->where( 'is_deleted', false )->where( 'client_id', $user_id )->get(  );
        $points = $data_points->sum( 'point.value' );
        $orders = 0;
        if ( count( $data_orders ) > 0 ) {
            foreach ( $data_orders as $value) {
                $orders += ( count( $value->details ) > 0 ) ? ( $value->details->sum( 'real_price' ) * $value->details->sum( 'quantity' ) ) : 0;
            }
        }

        return [
            "points" => $points,
            "orders" => $orders,
            "total" => $points - $orders,
        ];
        //return $data->toJson(  );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return object
     */
    /**
	 * @OA\DELETE(
     * 	path="/api/user/points/{id}",
     *  operationId="destroy",
     * 	summary="Delete User Point",
	 * 	tags={"UserPoints"},
     *  @OA\Parameter(
     *      name="id",
     *      in="path",
     *      description="User Point ID",
     *      required=true,
     *      @OA\Schema(
     *          type="integer",
     *          format="int64",
     *          minimum=1
     *      ),
     *  ),
	 * 	@OA\Response(
     *		response=200,
     *		description="Delete User Point",
     *		@OA\JsonContent(
     *		    ref="#/components/schemas/UserPointSchema",
     *          example={"response": {
     *              "data":{
     *                 "id": 1,
     *                 "user_id": "1",
     *                 "point_id": "3",
     *                 "note": "Pre-Registro",
     *                 "is_active": "1",
     *                 "is_deleted": "0",
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
        $data = UserPoint::with( [ 'user', 'point.redeemable_product' ] )->findOrFail( $id );
        $data->is_deleted = true;
        $data->save(  );

        return $data;
    }

}
