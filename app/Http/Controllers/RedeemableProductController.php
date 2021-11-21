<?php


namespace App\Http\Controllers;

use App\RedeemableProduct;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;

class RedeemableProductController extends Controller
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
     *    path="/api/redeemable/products",
     *  operationId="index",
     *    summary="Return all the redeemable products",
     *    tags={"RedeemableProduct"},
     * 	@OA\Response(
     *        response=200,
     *        description="List of all the redeemable products",
     *		@OA\JsonContent(
     *            ref="#/components/schemas/RedeemableProductSchema",
     *           example={"response": {
     *              "data":{
     *                 "id": 1,
     *                 "sku": "123572363",
     *                 "value": "1000.00",
     *                 "name": "Piclor",
     *                 "description": "Pre-Registro",
     *                 "note": "Pre-Registro",
     *                 "is_active": "1",
     *                 "is_deleted": "0",
     *                 "created_at": "2021-06-30T00:21:57.000000Z",
     *                 "updated_at": "2021-06-30T00:21:57.000000Z"
     *               },
     *             }
     *
     *          }
     *        )
     *    ),
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

    public function index(  ): object
    {
        return RedeemableProduct::with('points')->where('is_active', true)->where('is_deleted', false)->get();

    }

    /**
     * @OA\GET(
     *    path="/api/redeemable/products/list",
     *  operationId="list",
     *    summary="Return a paginated list of all the redeemable products registered",
     *    tags={"RedeemableProduct"},
     * 	@OA\Response(
     *        response=200,
     *        description="A paginated list of all the redeemable products registered",
     *		@OA\JsonContent(
     *            ref="#/components/schemas/RedeemableProductSchema",
     *           example={"response": {
     *              "data":{
     *                 "id": 1,
     *                 "sku": "123572363",
     *                 "value": "1000.00",
     *                 "name": "Piclor",
     *                 "description": "Pre-Registro",
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
     *               "first_page_url": "/api/redeemable/products/list?page=1",
     *               "last_page_url": "/api/redeemable/products/list?page=1",
     *               "path": "/api/redeemable/products/list",
     *               "prev_page_url": null,
     *               "next_page_url": null,
     *             }
     *
     *          }
     *        )
     *    ),
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
    public function list(): object
    {
        return RedeemableProduct::with('points')->where('is_active', true)->where('is_deleted', false)->paginate(15);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return object
     */
    /**
     * @OA\POST(
     *    path="/api/redeemable/products",
     *    operationId="store",
     *    summary="Create redeemable products Method",
     *    tags={"RedeemableProduct"},
     * @OA\Parameter(
     *      name="sku",
     *      in="query",
     *      description="Write the SKU",
     *      required=true,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="value",
     *      in="query",
     *      description="Write the value",
     *      required=false,
     *      @OA\Schema(
     *          type="number",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="name",
     *      in="query",
     *      description="Write the prduct name",
     *      required=true,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="description",
     *      in="query",
     *      description="Write the product description",
     *      required=false,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     *  @OA\Parameter(
     *      name="note",
     *      in="query",
     *      description="Write the description",
     *      required=false,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * 	@OA\Response(
     *        response=201,
     *        description="Create redeemable products",
     *		@OA\JsonContent(
     *            ref="#/components/schemas/RedeemableProductSchema",
     *          example={"response": {
     *              "data":{
     *                 "id": 1,
     *                 "sku": "123572363",
     *                 "value": "1000.00",
     *                 "name": "Piclor",
     *                 "description": "Pre-Registro",
     *                 "note": "Pre-Registro",
     *                 "is_active": "1",
     *                 "is_deleted": "0",
     *                 "created_at": "2021-06-30T00:21:57.000000Z",
     *                 "updated_at": "2021-06-30T00:21:57.000000Z"
     *               },
     *             }
     *
     *          }
     *        )
     *    ),
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
    public function store(Request $request): object
    {
        // Validate incoming request
        $this->validate($request, [
            'sku' => 'required|string|unique:redeemable_products',
            'value' => 'nullable|numeric',
            'name' => 'required|string|max:200',
            'description' => 'nullable|string|max:250',
            'note' => 'nullable|string|max:250'
        ]);
        $current_time = new \DateTime();
        try {
            //
            $in_data = RedeemableProduct::create([
                'sku' => $request->input('sku'),
                'value' => $request->input('value') ?? 1,
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'note' => $request->input('note'),
                'is_active' => true,
                'created' => $current_time->format("Y-m-d H:i:s"),
                'modified' => $current_time->format("Y-m-d H:i:s")
            ]);

            //return successful response
            return response()->json([
                'data' => $in_data,
                'success' => true,
                'message' => 'Se ha agregado correctamente!.'
            ]);

        } catch (\Exception $e) {
            //return error message
            //dd('Exception block', $e);
            //return $e;
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
                //'message' => 'Hubo un fallo al hacer el registro.'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param string $sku
     * @return object
     */
    /**
     * @OA\GET(
     *    path="/api/redeemable/products/{sku}",
     *    operationId="show",
     *    summary="Show redeemable products",
     *    tags={"RedeemableProduct"},
     *  @OA\Parameter(
     *      name="sku",
     *      in="path",
     *      description="Product SKU",
     *      required=true,
     *      @OA\Schema(
     *          type="string",
     *          minimum=1
     *      ),
     *  ),
     * 	@OA\Response(
     *        response=200,
     *        description="Show redeemable products",
     *		@OA\JsonContent(
     *            ref="#/components/schemas/RedeemableProductSchema",
     *            example={"response": {
     *              "data":{
     *                 "id": 1,
     *                 "sku": "123572363",
     *                 "value": "1000.00",
     *                 "name": "Piclor",
     *                 "description": "Pre-Registro",
     *                 "note": "Pre-Registro",
     *                 "is_active": "1",
     *                 "is_deleted": "0",
     *                 "created_at": "2021-06-30T00:21:57.000000Z",
     *                 "updated_at": "2021-06-30T00:21:57.000000Z"
     *               },
     *             }
     *
     *          }
     *        )
     *    ),
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
    public function show(string $sku): object
    {
        $data = RedeemableProduct::where('is_active', true)->where('is_deleted', false)->where('sku', $sku)->first();
        if (!$data) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
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
     *    path="/api/redeemable/products",
     *    operationId="update",
     *    summary="Update redeemable products Method",
     *    tags={"RedeemableProduct"},
     * @OA\Parameter(
     *      name="id",
     *      in="path",
     *      description="Redeemable Product ID",
     *      required=true,
     *      @OA\Schema(
     *          type="integer",
     *          format="int64",
     *          minimum=1
     *      ),
     * ),
     * @OA\Parameter(
     *      name="sku",
     *      in="query",
     *      description="Write the SKU",
     *      required=true,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="value",
     *      in="query",
     *      description="Write the value",
     *      required=false,
     *      @OA\Schema(
     *          type="number",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="name",
     *      in="query",
     *      description="Write the prduct name",
     *      required=true,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="description",
     *      in="query",
     *      description="Write the product description",
     *      required=false,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     *  @OA\Parameter(
     *      name="note",
     *      in="query",
     *      description="Write the description",
     *      required=false,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * 	@OA\Response(
     *        response=201,
     *        description="Update redeemable products",
     *		@OA\JsonContent(
     *            ref="#/components/schemas/RedeemableProductSchema",
     *          example={"response": {
     *              "data":{
     *                 "id": 1,
     *                 "sku": "123572363",
     *                 "value": "1000.00",
     *                 "name": "Piclor",
     *                 "description": "Pre-Registro",
     *                 "note": "Pre-Registro",
     *                 "is_active": "1",
     *                 "is_deleted": "0",
     *                 "created_at": "2021-06-30T00:21:57.000000Z",
     *                 "updated_at": "2021-06-30T00:21:57.000000Z"
     *               },
     *             }
     *
     *          }
     *        )
     *    ),
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
    public function update(int $id, Request $request): object
    {
        $data = RedeemableProduct::where('id', $id)->firstOrFail();
        // Validate incoming request
        $this->validate($request, [
            'sku' => 'requited|string',
            'value' => 'nullable|numeric',
            'name' => 'required|string|max:200',
            'description' => 'nullable|string|max:250',
            'note' => 'nullable|string|max:250'
        ]);

        $current_time = new \DateTime();
        try {
            $data->fill([
                //'sku' => $request->input('sku'),
                'value' => $request->input('value') ?? 1,
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'note' => $request->input('note'),
                'is_active' => true,
                //'created_at' => $current_time->format( "Y-m-d H:i:s" ),
                'updated_at' => $current_time->format("Y-m-d H:i:s")
            ])->save();

            if (!$data->wasChanged()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tiene que modificar algun dato.'
                ]);
            }

            return response()->json([
                'data' => $data,
                'success' => true,
                'message' => 'Modificación de datos se efectuo correctamente!.'
            ]);

        } catch (\Exception $e) {
            //return error message
            //dd('Exception block', $e);
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
                //'message' => 'Modificación de datos fallo!.'
            ]);
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
     *    path="/api/redeemable/products/{id}",
     *  operationId="destroy",
     *    summary="Delete redeemable products",
     *    tags={"RedeemableProduct"},
     *  @OA\Parameter(
     *      name="id",
     *      in="path",
     *      description="Redeemable Product ID",
     *      required=true,
     *      @OA\Schema(
     *          type="integer",
     *          format="int64",
     *          minimum=1
     *      ),
     *  ),
     * 	@OA\Response(
     *        response=200,
     *        description="Delete redeemable products",
     *		@OA\JsonContent(
     *            ref="#/components/schemas/RedeemableProductSchema",
     *          example={"response": {
     *              "data":{
     *                 "id": 1,
     *                 "sku": "123572363",
     *                 "value": "1000.00",
     *                 "name": "Piclor",
     *                 "description": "Pre-Registro",
     *                 "note": "Pre-Registro",
     *                 "is_active": "1",
     *                 "is_deleted": "0",
     *                 "created_at": "2021-06-30T00:21:57.000000Z",
     *                 "updated_at": "2021-06-30T00:21:57.000000Z"
     *               },
     *             }
     *
     *          }
     *        )
     *    ),
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
    public function destroy(int $id): object
    {
        $data = RedeemableProduct::findOrFail($id);
        $data->is_deleted = true;
        $data->save();

        return $data;
    }

    /**
     * @OA\POST(
     *    path="/api/redeemable/products/search",
     *  operationId="search",
     *    summary="Search a redeemable products",
     *    tags={"RedeemableProduct"},
     * @OA\Parameter(
     *      name="sku",
     *      in="query",
     *      description="Write the Product SKU",
     *      required=false,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="value",
     *      in="query",
     *      description="Write the Product value",
     *      required=false,
     *      @OA\Schema(
     *          type="number",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="name",
     *      in="query",
     *      description="Write the name",
     *      required=false,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="description",
     *      in="query",
     *      description="Write the description",
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
     *        response=200,
     *        description="Search redeemable products",
     *		@OA\JsonContent(
     *            ref="#/components/schemas/RedeemableProductSchema",
     *           example={"response": {
     *              "data":{
     *                 "id": 1,
     *                 "sku": "123572363",
     *                 "value": "1000.00",
     *                 "name": "Piclor",
     *                 "description": "Pre-Registro",
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
     *               "first_page_url": "/api/redeemable/products/search?page=1",
     *               "last_page_url": "/api/redeemable/products/search?page=1",
     *               "path": "/api/redeemable/products/search",
     *               "prev_page_url": null,
     *               "next_page_url": null,
     *             }
     *          }
     *        )
     *    ),
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
    public function search(Request $request): object
    {
        $this->validate($request, [
            'sku' => 'nullable|string|max:120',
            'value' => 'nullable|numeric',
            'name' => 'nullable|string',
            'description' => 'nullable|string',
            'pagination' => 'nullable|number'
        ]);

        $points = RedeemableProduct::where('is_active', true)->where('is_deleted', false);
        if ($request->sku) {
            $points->where('sku', 'LIKE', "%{$request->sku}%");
        }
        if ($request->value) {
            $points->where('value', $request->value);
        }
        if ($request->name) {
            $points->where('name', 'LIKE', "%{$request->name}%");
        }
        if ($request->description) {
            $points->where('description', 'LIKE', "%{$request->description}%");
        }
        if ($request->paginate) {
            return $points->orderBy('value', 'DESC')->paginate($request->paginate);
        }

        return $points->orderBy('name', 'ASC')->get();
    }

}
