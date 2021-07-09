<?php

namespace App\Http\Controllers;

use App\InventoryTag;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use App\Http\Controllers\Controller;

class InventoryTagController extends Controller
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
     * 	path="/api/inventory/tags",
     *  operationId="store",
     * 	summary="Create Inventory Tag Method",
     * 	tags={"InventoryTags"},
     * @OA\Parameter(
     *      name="inventory_id",
     *      in="query",
     *      description="Write the inventory ID",
     *      required=true,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="tag_id",
     *      in="query",
     *      description="Write the inventory ID",
     *      required=true,
     *      @OA\Schema(
     *          type="integer",
     *      ),
     *      style="form"
     *  ),
     *  @OA\Parameter(
     *      name="note",
     *      in="query",
     *      description="Write Inventory Tag's description",
     *      required=false,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * 	@OA\Response(
     * 		response=201,
     *		description="Create Inventory Tag",
     *		@OA\JsonContent(
     *		    ref="#/components/schemas/InventoryTagSchema",
     *          example={"response": {
     *              "data":{
     *                 "id": 1,
     *                 "inventory_id": "1",
     *                 "tag_id": "3",
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
            'inventory_id' => 'required|numeric',
            'tag_id' => 'required|numeric',
            'note' => 'nullable|string|max:250'
        ] );
        $current_time = new \DateTime(  );
        try {
            //
            $in_data = InventoryTag::create( [
                'inventory_id' => $request->input( 'inventory_id' ),
                'tag_id' => $request->input( 'tag_id' ),
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
     * @param  \App\InventoryTag  $inventory_tag
     * @return \Illuminate\Http\Response
     */
    /**
	 * @OA\GET(
     * 	path="/api/inventory/tags/{inventory_id}",
     *  operationId="show",
     * 	summary="Show Inventory Tag",
	 * 	tags={"InventoryTags"},
     *  @OA\Parameter(
     *      name="inventory_id",
     *      in="path",
     *      description="Inventory ID",
     *      required=true,
     *      @OA\Schema(
     *          type="integer",
     *          format="int64",
     *          minimum=1
     *      ),
     *  ),
	 * 	@OA\Response(
     *		response=200,
     *		description="Show Inventory Tag",
     *		@OA\JsonContent(
     *		    ref="#/components/schemas/InventoryTagSchema",
     *          example={"response": {
     *              "data":{
     *                 "id": 1,
     *                 "inventory_id": "1",
     *                 "tag_id": "3",
     *                 "note": "Pre-Registro",
     *                 "is_active": "1",
     *                 "is_deleted": "0",
     *                 "created_at": "2021-06-30T00:21:57.000000Z",
     *                 "updated_at": "2021-06-30T00:21:57.000000Z",
     *                 "inventory": {
     *                     "id": 1,
     *                     "product_id": "1",
     *                     "point_id": null,
     *                     "company_id": null,
     *                     "name": "Alienware Aurora R7",
     *                     "description": "La torre Alienware Aurora cuenta con un diseño meticuloso y delgado, y es la primera de su clase en ofrecer actualizaciones sin herramientas para tarjetas de gráficos, discos duros y memoria.<br/>Diseñada para mantenerse fría.<br/>Inspirada en la ergonomí",
     *                     "include": null,
     *                     "company_name": "DELL",
     *                     "image": "awaurorawebp.webp",
     *                     "classification": "",
     *                     "code": null,
     *                     "unit_measurement": "Unid",
     *                     "qmin": "10",
     *                     "qmax": "50",
     *                     "existence": "10",
     *                     "availability": "10",
     *                     "note": "Pre-Registro",
     *                     "is_active": "1",
     *                     "is_deleted": "0",
     *                     "created_at": "2021-06-30T00:21:57.000000Z",
     *                     "updated_at": "2021-06-30T00:21:57.000000Z",
     *                 "prices": {
     *                         "id": 1,
     *                         "inventory_id": "1",
     *                         "price": "20000.00",
     *                         "has_tax": "0.00",
     *                         "note": "Pre-Registro",
     *                         "is_active": "1",
     *                         "is_deleted": "0",
     *                         "created_at": "2021-06-30T00:21:57.000000Z",
     *                         "updated_at": "2021-06-30T00:21:57.000000Z"
     *                 },
     *                 "product": {
     *                     "id": 1,
     *                     "category_id": "3",
     *                     "name": "PC",
     *                     "description": "Computadora de uso personal.",
     *                     "image": "pc.png",
     *                     "note": "Pre-Registro",
     *                     "is_active": "1",
     *                     "is_deleted": "0",
     *                     "created_at": "2021-06-30T00:21:57.000000Z",
     *                     "updated_at": "2021-06-30T00:21:57.000000Z",
     *                     "category": {
     *                         "id": 3,
     *                         "parent_id": "3",
     *                         "order": null,
     *                         "name": "Laptops",
     *                         "image": "",
     *                         "note": "Pre-Registro",
     *                         "is_active": "1",
     *                         "is_deleted": "0",
     *                         "created_at": "2021-06-30T00:21:57.000000Z",
     *                         "updated_at": "2021-06-30T00:21:57.000000Z"
     *                     },
     *                 },
     *                 "company": null,
     *                 "images": {},
     *                 },
     *                 "tag": {
     *                     "id": 3,
     *                     "name": "Tool",
     *                     "image": "",
     *                     "note": "Pre-Registro",
     *                     "is_active": "1",
     *                     "is_deleted": "0",
     *                     "created_at": "2021-06-30T00:21:57.000000Z",
     *                     "updated_at": "2021-06-30T00:21:57.000000Z"
     *                 },
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
    public function show( $inventory_id, Request $request )
    {
        //
        $data = InventoryTag::with( [ 'inventory.prices', 'inventory.product.category', 'inventory.company', 'inventory.images', 'tag' ] )->where( 'is_active', true )->where( 'is_deleted', false )->where( 'inventory_id', $inventory_id )->get(  );

		if ( $request->wantsJson(  ) ) {
			return $data;
            //return $data->toJson(  );
		}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InventoryTag  $inventory_tag
     * @return \Illuminate\Http\Response
     */
    /**
	 * @OA\DELETE(
     * 	path="/api/inventory/tags/{id}",
     *  operationId="destroy",
     * 	summary="Delete Inventory Tag",
	 * 	tags={"InventoryTags"},
     *  @OA\Parameter(
     *      name="id",
     *      in="path",
     *      description="Inventory Tag ID",
     *      required=true,
     *      @OA\Schema(
     *          type="integer",
     *          format="int64",
     *          minimum=1
     *      ),
     *  ),
	 * 	@OA\Response(
     *		response=200,
     *		description="Delete Inventory Tag",
     *		@OA\JsonContent(
     *		    ref="#/components/schemas/InventoryTagSchema",
     *          example={"response": {
     *              "data":{
     *                 "id": 1,
     *                 "inventory_id": "1",
     *                 "tag_id": "3",
     *                 "note": "Pre-Registro",
     *                 "is_active": "1",
     *                 "is_deleted": "0",
     *                 "created_at": "2021-06-30T00:21:57.000000Z",
     *                 "updated_at": "2021-06-30T00:21:57.000000Z",
     *                 "inventory": {
     *                     "id": 1,
     *                     "product_id": "1",
     *                     "point_id": null,
     *                     "company_id": null,
     *                     "name": "Alienware Aurora R7",
     *                     "description": "La torre Alienware Aurora cuenta con un diseño meticuloso y delgado, y es la primera de su clase en ofrecer actualizaciones sin herramientas para tarjetas de gráficos, discos duros y memoria.<br/>Diseñada para mantenerse fría.<br/>Inspirada en la ergonomí",
     *                     "include": null,
     *                     "company_name": "DELL",
     *                     "image": "awaurorawebp.webp",
     *                     "classification": "",
     *                     "code": null,
     *                     "unit_measurement": "Unid",
     *                     "qmin": "10",
     *                     "qmax": "50",
     *                     "existence": "10",
     *                     "availability": "10",
     *                     "note": "Pre-Registro",
     *                     "is_active": "1",
     *                     "is_deleted": "0",
     *                     "created_at": "2021-06-30T00:21:57.000000Z",
     *                     "updated_at": "2021-06-30T00:21:57.000000Z",
     *                 "prices": {
     *                         "id": 1,
     *                         "inventory_id": "1",
     *                         "price": "20000.00",
     *                         "has_tax": "0.00",
     *                         "note": "Pre-Registro",
     *                         "is_active": "1",
     *                         "is_deleted": "0",
     *                         "created_at": "2021-06-30T00:21:57.000000Z",
     *                         "updated_at": "2021-06-30T00:21:57.000000Z"
     *                 },
     *                 "product": {
     *                     "id": 1,
     *                     "category_id": "3",
     *                     "name": "PC",
     *                     "description": "Computadora de uso personal.",
     *                     "image": "pc.png",
     *                     "note": "Pre-Registro",
     *                     "is_active": "1",
     *                     "is_deleted": "0",
     *                     "created_at": "2021-06-30T00:21:57.000000Z",
     *                     "updated_at": "2021-06-30T00:21:57.000000Z",
     *                     "category": {
     *                         "id": 3,
     *                         "parent_id": "3",
     *                         "order": null,
     *                         "name": "Laptops",
     *                         "image": "",
     *                         "note": "Pre-Registro",
     *                         "is_active": "1",
     *                         "is_deleted": "0",
     *                         "created_at": "2021-06-30T00:21:57.000000Z",
     *                         "updated_at": "2021-06-30T00:21:57.000000Z"
     *                     },
     *                 },
     *                 "company": null,
     *                 "images": {},
     *                 },
     *                 "tag": {
     *                     "id": 3,
     *                     "name": "Tool",
     *                     "image": "",
     *                     "note": "Pre-Registro",
     *                     "is_active": "1",
     *                     "is_deleted": "0",
     *                     "created_at": "2021-06-30T00:21:57.000000Z",
     *                     "updated_at": "2021-06-30T00:21:57.000000Z"
     *                 },
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
        $data = InventoryTag::with( [ 'inventory.prices', 'inventory.product.category', 'inventory.company', 'inventory.images', 'tag' ] )->findOrFail( $id );
        $data->is_deleted = true;
        $data->save(  );

        if ( $request->wantsJson(  ) ) {
            return $data;
            //return $data->toJson(  );
        }
    }

}
