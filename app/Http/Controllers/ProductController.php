<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use App\Http\Controllers\Controller;

class ProductController extends Controller
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
     * 	path="/api/products",
     *  operationId="index",
     * 	summary="Return all the products",
	 * 	tags={"Products"},
	 * 	@OA\Response(
     *		response=200,
     *		description="List of all the products registered",
     *		@OA\JsonContent(
     *		    ref="#/components/schemas/ProductSchema",
     *           example={"response": {
     *              "data":{
     *                 "id": 1,
     *                 "category_id": "3",
     *                 "name": "PC",
     *                 "description": "Computadora de uso personal.",
     *                 "image": "pc.png",
     *                 "note": "Pre-Registro",
     *                 "is_active": "1",
     *                 "is_deleted": "0",
     *                 "created_at": "2021-06-30T00:21:57.000000Z",
     *                 "updated_at": "2021-06-30T00:21:57.000000Z",
     *                 "category": {
     *                     "id": 3,
     *                     "parent_id": "3",
     *                     "order": null,
     *                     "name": "Laptops",
     *                     "image": "",
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
        $data = Product::with( 'category' )->where( 'is_active', true )->where( 'is_deleted', false )->get(  );
		if ( $request->wantsJson(  ) ) {
			return $data;
            //return $data->toJson(  );
		}
    }

    /**
	 * @OA\GET(
     * 	path="/api/products/list",
     *  operationId="list",
     * 	summary="Return a paginated list of all the products registered",
	 * 	tags={"Products"},
	 * 	@OA\Response(
     *		response=200,
     *		description="A paginated list of all the products registered",
     *		@OA\JsonContent(
     *		    ref="#/components/schemas/ProductSchema",
     *           example={"response": {
     *              "data":{
     *                 "id": 1,
     *                 "category_id": "3",
     *                 "name": "PC",
     *                 "description": "Computadora de uso personal.",
     *                 "image": "pc.png",
     *                 "note": "Pre-Registro",
     *                 "is_active": "1",
     *                 "is_deleted": "0",
     *                 "created_at": "2021-06-30T00:21:57.000000Z",
     *                 "updated_at": "2021-06-30T00:21:57.000000Z",
     *                 "category": {
     *                     "id": 3,
     *                     "parent_id": "3",
     *                     "order": null,
     *                     "name": "Laptops",
     *                     "image": "",
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
     *               "first_page_url": "/api/products/list?page=1",
     *               "last_page_url": "/api/products/list?page=1",
     *               "path": "/api/products/list",
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
        $data = Product::with( 'category' )->where( 'is_active', true )->where( 'is_deleted', false )->paginate( 15 );

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
     * 	path="/api/products",
     *  operationId="store",
     * 	summary="Create Product Method",
     * 	tags={"Products"},
     * @OA\Parameter(
     *      name="category_id",
     *      in="query",
     *      description="Write the category ID",
     *      required=true,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="name",
     *      in="query",
     *      description="Write the Product's name",
     *      required=true,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="description",
     *      in="query",
     *      description="Write the Product's description",
     *      required=false,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="image",
     *      in="query",
     *      description="Write image's name",
     *      required=false,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     *  @OA\Parameter(
     *      name="note",
     *      in="query",
     *      description="Write Product's observations",
     *      required=false,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * 	@OA\Response(
     * 		response=201,
     *		description="Create Product",
     *		@OA\JsonContent(
     *		    ref="#/components/schemas/ProductSchema",
     *          example={"response": {
     *              "data":{
     *                 "id": 1,
     *                 "category_id": "3",
     *                 "name": "PC",
     *                 "description": "Computadora de uso personal.",
     *                 "image": "pc.png",
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
            'category_id' => 'required|numeric',
            'name' => 'required|string|max:100',
            'description' => 'nullable|string|max:200',
            'image' => 'nullable|string|max:200',
            'note' => 'nullable|string|max:250'
        ] );
        $current_time = new \DateTime(  );
        try {
            //
            $in_data = Product::create( [
                'category_id' => $request->input( 'category_id' ),
                'description' => $request->input( 'description' ),
                'name' => $request->input( 'name' ),
                'image' => $request->input( 'image' ),
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
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    /**
	 * @OA\GET(
     * 	path="/api/products/{id}",
     *  operationId="show",
     * 	summary="Show Product",
	 * 	tags={"Products"},
     *  @OA\Parameter(
     *      name="id",
     *      in="path",
     *      description="Product ID",
     *      required=true,
     *      @OA\Schema(
     *          type="integer",
     *          format="int64",
     *          minimum=1
     *      ),
     *  ),
	 * 	@OA\Response(
     *		response=200,
     *		description="Show Product",
     *		@OA\JsonContent(
     *		    ref="#/components/schemas/ProductSchema",
     *          example={"response": {
     *              "data":{
     *                 "id": 2,
     *                 "category_id": "4",
     *                 "name": "Tablet",
     *                 "description": "Dispositivo movil tactil.",
     *                 "image": "tablet.png",
     *                 "note": "Pre-Registro",
     *                 "is_active": "1",
     *                 "is_deleted": "0",
     *                 "created_at": "2021-06-30T00:21:57.000000Z",
     *                 "updated_at": "2021-06-30T00:21:57.000000Z",
     *                 "category": {
     *                     "id": 4,
     *                     "parent_id": "3",
     *                     "order": null,
     *                     "name": "Tablets",
     *                     "image": "",
     *                     "note": "Pre-Registro",
     *                     "is_active": "1",
     *                     "is_deleted": "0",
     *                     "created_at": "2021-06-30T00:21:57.000000Z",
     *                     "updated_at": "2021-06-30T00:21:57.000000Z"
     *                 },
     *                 "inventories": {
     *                     "id": 3,
     *                     "product_id": "2",
     *                     "point_id": null,
     *                     "company_id": null,
     *                     "name": "iPad Pro 2021",
     *                     "description": "* Chip Apple M1 para un rendimiento de siguiente nivel.<br/>* Impresionante pantalla de retina líquida de 11 pulgadas con promoción, tono verdadero y color ancho P3.<br/>* Sistema de cámara TrueDepth con cámara frontal ultra ancha con escenario central.<b",
     *                     "include": null,
     *                     "company_name": "Apple",
     *                     "image": "ipad.png",
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
     *                     "prices":  {
     *                          "id": 3,
     *                          "inventory_id": "3",
     *                          "price": "35000.00",
     *                          "has_tax": "0.00",
     *                          "note": "Pre-Registro",
     *                          "is_active": "1",
     *                          "is_deleted": "0",
     *                          "created_at": "2021-06-30T00:21:57.000000Z",
     *                          "updated_at": "2021-06-30T00:21:57.000000Z"
     *                     },
     *                     "images": {
     *                          "id": 3,
     *                          "inventory_id": "3",
     *                          "is_cover": "1",
     *                          "filename": "ipad",
     *                          "name": null,
     *                          "url": "ipad.png",
     *                          "note": "Pre-Registro",
     *                          "is_active": "1",
     *                          "is_deleted": "0",
     *                          "created_at": "2021-06-30T00:23:22.000000Z",
     *                          "updated_at": "2021-06-30T00:23:22.000000Z"
     *                     },
     *                     "tags": {
     *                          "id": 7,
     *                          "inventory_id": "3",
     *                          "tag_id": "1",
     *                          "note": "Pre-Registro",
     *                          "is_active": "1",
     *                          "is_deleted": "0",
     *                          "created_at": "2021-06-30T00:21:57.000000Z",
     *                          "updated_at": "2021-06-30T00:21:57.000000Z"
     *                     },
     *                  },
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
        $data = Product::with( 'category' )->with( [ 'inventories.prices', 'inventories.images', 'inventories.tags' ] )->where( 'is_active', true )->where( 'is_deleted', false )->where( 'id', $id )->firstOrFail(  );

		if ( $request->wantsJson(  ) ) {
			return $data;
            //return $data->toJson(  );
		}
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\PUT(
     * 	path="/api/products",
     *  operationId="update",
     * 	summary="Update Product Method",
     * 	tags={"Products"},
     * @OA\Parameter(
     *      name="id",
     *      in="path",
     *      description="Product ID",
     *      required=true,
     *      @OA\Schema(
     *          type="integer",
     *          format="int64",
     *          minimum=1
     *      ),
     * ),
     * @OA\Parameter(
     *      name="category_id",
     *      in="query",
     *      description="Write the category ID",
     *      required=true,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="name",
     *      in="query",
     *      description="Write the Product's name",
     *      required=true,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="description",
     *      in="query",
     *      description="Write the Product's description",
     *      required=false,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="image",
     *      in="query",
     *      description="Write image's name",
     *      required=false,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     *  @OA\Parameter(
     *      name="note",
     *      in="query",
     *      description="Write Product's observations",
     *      required=false,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * 	@OA\Response(
     * 		response=201,
     *		description="Update Product",
     *		@OA\JsonContent(
     *		    ref="#/components/schemas/ProductSchema",
     *          example={"response": {
     *              "data":{
     *                 "id": 1,
     *                 "category_id": "3",
     *                 "name": "PC",
     *                 "description": "Computadora de uso personal.",
     *                 "image": "pc.png",
     *                 "note": "Pre-Registro",
     *                 "is_active": "1",
     *                 "is_deleted": "0",
     *                 "created_at": "2021-06-30T00:21:57.000000Z",
     *                 "updated_at": "2021-06-30T00:21:57.000000Z",
     *                 "category": {
     *                     "id": 3,
     *                     "parent_id": "3",
     *                     "order": null,
     *                     "name": "Laptops",
     *                     "image": "",
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
        $data = Product::with( 'category' )->where( 'id', $id )->firstOrFail(  );
        // Validate incoming request
         $this->validate( $request, [
            'category_id' => 'required|numeric',
            'name' => 'required|string|max:100',
            'description' => 'nullable|string|max:200',
            'image' => 'nullable|string|max:200',
            'note' => 'nullable|string|max:250'
        ] );

        $current_time = new \DateTime(  );
        try {

            $data->fill( [
                'category_id' => $request->input( 'category_id' ),
                'description' => $request->input( 'description' ),
                'name' => $request->input( 'name' ),
                'image' => $request->input( 'image' ),
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
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    /**
	 * @OA\DELETE(
     * 	path="/api/products/{id}",
     *  operationId="destroy",
     * 	summary="Delete Product",
	 * 	tags={"Products"},
     *  @OA\Parameter(
     *      name="id",
     *      in="path",
     *      description="Product ID",
     *      required=true,
     *      @OA\Schema(
     *          type="integer",
     *          format="int64",
     *          minimum=1
     *      ),
     *  ),
	 * 	@OA\Response(
     *		response=200,
     *		description="Delete Product",
     *		@OA\JsonContent(
     *		    ref="#/components/schemas/ProductSchema",
     *          example={"response": {
     *              "data":{
     *                 "id": 1,
     *                 "category_id": "3",
     *                 "name": "PC",
     *                 "description": "Computadora de uso personal.",
     *                 "image": "pc.png",
     *                 "note": "Pre-Registro",
     *                 "is_active": "1",
     *                 "is_deleted": "0",
     *                 "created_at": "2021-06-30T00:21:57.000000Z",
     *                 "updated_at": "2021-06-30T00:21:57.000000Z",
     *                 "category": {
     *                     "id": 3,
     *                     "parent_id": "3",
     *                     "order": null,
     *                     "name": "Laptops",
     *                     "image": "",
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
        $data = Product::with( 'category' )->findOrFail( $id );
        $data->is_deleted = true;
        $data->save(  );

        if ( $request->wantsJson(  ) ) {
            return $data;
            //return $data->toJson(  );
        }
    }

    /**
	 * @OA\POST(
     * 	path="/api/products/search",
     *  operationId="search",
     * 	summary="Search a Product",
	 * 	tags={"Products"},
     * @OA\Parameter(
     *      name="category_id",
     *      in="query",
     *      description="Write the Category ID",
     *      required=false,
     *      @OA\Schema(
     *          type="integer",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="name",
     *      in="query",
     *      description="Write the Product's name",
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
     *		description="Search products",
     *		@OA\JsonContent(
     *		    ref="#/components/schemas/ProductSchema",
     *           example={"response": {
     *              "data":{
     *                 "id": 2,
     *                 "category_id": "4",
     *                 "name": "Tablet",
     *                 "description": "Dispositivo movil tactil.",
     *                 "image": "tablet.png",
     *                 "note": "Pre-Registro",
     *                 "is_active": "1",
     *                 "is_deleted": "0",
     *                 "created_at": "2021-06-30T00:21:57.000000Z",
     *                 "updated_at": "2021-06-30T00:21:57.000000Z",
     *                 "category": {
     *                     "id": 4,
     *                     "parent_id": "3",
     *                     "order": null,
     *                     "name": "Tablets",
     *                     "image": "",
     *                     "note": "Pre-Registro",
     *                     "is_active": "1",
     *                     "is_deleted": "0",
     *                     "created_at": "2021-06-30T00:21:57.000000Z",
     *                     "updated_at": "2021-06-30T00:21:57.000000Z"
     *                 },
     *                 "inventories": {
     *                     "id": 3,
     *                     "product_id": "2",
     *                     "point_id": null,
     *                     "company_id": null,
     *                     "name": "iPad Pro 2021",
     *                     "description": "* Chip Apple M1 para un rendimiento de siguiente nivel.<br/>* Impresionante pantalla de retina líquida de 11 pulgadas con promoción, tono verdadero y color ancho P3.<br/>* Sistema de cámara TrueDepth con cámara frontal ultra ancha con escenario central.<b",
     *                     "include": null,
     *                     "company_name": "Apple",
     *                     "image": "ipad.png",
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
     *                     "prices":  {
     *                          "id": 3,
     *                          "inventory_id": "3",
     *                          "price": "35000.00",
     *                          "has_tax": "0.00",
     *                          "note": "Pre-Registro",
     *                          "is_active": "1",
     *                          "is_deleted": "0",
     *                          "created_at": "2021-06-30T00:21:57.000000Z",
     *                          "updated_at": "2021-06-30T00:21:57.000000Z"
     *                     },
     *                     "images": {
     *                          "id": 3,
     *                          "inventory_id": "3",
     *                          "is_cover": "1",
     *                          "filename": "ipad",
     *                          "name": null,
     *                          "url": "ipad.png",
     *                          "note": "Pre-Registro",
     *                          "is_active": "1",
     *                          "is_deleted": "0",
     *                          "created_at": "2021-06-30T00:23:22.000000Z",
     *                          "updated_at": "2021-06-30T00:23:22.000000Z"
     *                     },
     *                     "tags": {
     *                          "id": 7,
     *                          "inventory_id": "3",
     *                          "tag_id": "1",
     *                          "note": "Pre-Registro",
     *                          "is_active": "1",
     *                          "is_deleted": "0",
     *                          "created_at": "2021-06-30T00:21:57.000000Z",
     *                          "updated_at": "2021-06-30T00:21:57.000000Z"
     *                     },
     *                  },
     *               },
     *               "current_page": 1,
     *               "from": 1,
     *               "last_page": 1,
     *               "per_page": 15,
     *               "to": 1,
     *               "total": 1,
     *               "first_page_url": "/api/products/search?page=1",
     *               "last_page_url": "/api/products/search?page=1",
     *               "path": "/api/products/search",
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
            'category_id' => 'nullable|number',
            'name' => 'nullable|string|max:80',
            'pagination' => 'nullable|number'
        ] );

        $products = Product::with( 'category' )->with( [ 'inventories.prices', 'inventories.images', 'inventories.tags' ] )->where( 'is_active', true )->where( 'is_deleted', false );
        if ( $request->name ) {
            $products->where( 'name', 'LIKE', "%{$request->name}%" );
        }
        if ( $request->category_id ) {
            $products->where( 'category_id', $request->category_id );
        }
        if ( $request->paginate ) {
            return $products->orderBy( 'name', 'ASC' )->paginate( $request->paginate );
        } else {
            return $products->orderBy( 'name', 'ASC' )->get(  );
        }
    }

}
