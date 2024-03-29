<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
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
     * 	path="/api/categories",
     *  operationId="index",
     * 	summary="Return all the categories",
	 * 	tags={"Categories"},
	 * 	@OA\Response(
     *		response=200,
     *		description="List of all the categories registered",
     *		@OA\JsonContent(
     *		    ref="#/components/schemas/CategorySchema",
     *           example={"response": {
     *              "data":{
     *                 "id": 2,
     *                 "parent_id": "1",
     *                 "order": null,
     *                 "name": "Computadoras",
     *                 "image": "",
     *                 "note": "Pre-Registro",
     *                 "is_active": "1",
     *                 "is_deleted": "0",
     *                 "created_at": "2021-06-30T00:21:57.000000Z",
     *                 "updated_at": "2021-06-30T00:21:57.000000Z",
     *                 "parent": {
     *                     "id": 1,
     *                     "parent_id": null,
     *                     "order": null,
     *                     "name": "Electronica",
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
        $data = Category::with( 'parent' )->where( 'is_active', true )->where( 'is_deleted', false )->get(  );
		if ( $request->wantsJson(  ) ) {
			return $data;
            //return $data->toJson(  );
		}
    }

    /**
	 * @OA\GET(
     * 	path="/api/categories/list",
     *  operationId="list",
     * 	summary="Return a paginated list of all the categories registered",
	 * 	tags={"Categories"},
	 * 	@OA\Response(
     *		response=200,
     *		description="A paginated list of all the categories registered",
     *		@OA\JsonContent(
     *		    ref="#/components/schemas/CategorySchema",
     *           example={"response": {
     *              "data":{
     *                 "id": 2,
     *                 "parent_id": "1",
     *                 "order": null,
     *                 "name": "Computadoras",
     *                 "image": "",
     *                 "note": "Pre-Registro",
     *                 "is_active": "1",
     *                 "is_deleted": "0",
     *                 "created_at": "2021-06-30T00:21:57.000000Z",
     *                 "updated_at": "2021-06-30T00:21:57.000000Z",
     *                 "parent": {
     *                     "id": 1,
     *                     "parent_id": null,
     *                     "order": null,
     *                     "name": "Electronica",
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
     *               "first_page_url": "/api/categories/list?page=1",
     *               "last_page_url": "/api/categories/list?page=1",
     *               "path": "/api/categories/list",
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
        $data = Category::with( 'parent' )->where( 'is_active', true )->where( 'is_deleted', false )->paginate( 15 );

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
     * 	path="/api/categories",
     *  operationId="store",
     * 	summary="Create Category Method",
     * 	tags={"Categories"},
     * @OA\Parameter(
     *      name="parent_id",
     *      in="query",
     *      description="Write the parent ID",
     *      required=false,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="order",
     *      in="query",
     *      description="Write the order number",
     *      required=false,
     *      @OA\Schema(
     *          type="integer",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="name",
     *      in="query",
     *      description="Write the category's name",
     *      required=true,
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
     *      description="Write category's description",
     *      required=false,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * 	@OA\Response(
     * 		response=201,
     *		description="Create Category",
     *		@OA\JsonContent(
     *		    ref="#/components/schemas/CategorySchema",
     *          example={"response": {
     *              "data":{
     *                 "id": 2,
     *                 "parent_id": "1",
     *                 "order": null,
     *                 "name": "Computadoras",
     *                 "image": "",
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
            'parent_id' => 'nullable|numeric',
            'order' => 'nullable|numeric',
            'name' => 'required|string|max:100',
            'image' => 'nullable|string|max:250',
            'note' => 'nullable|string|max:250'
        ] );
        $current_time = new \DateTime(  );
        try {
            //
            $in_data = Category::create( [
                'parent_id' => $request->input( 'parent_id' ),
                'order' => $request->input( 'order' ),
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
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    /**
	 * @OA\GET(
     * 	path="/api/categories/{id}",
     *  operationId="show",
     * 	summary="Show Category",
	 * 	tags={"Categories"},
     *  @OA\Parameter(
     *      name="id",
     *      in="path",
     *      description="Category ID",
     *      required=true,
     *      @OA\Schema(
     *          type="integer",
     *          format="int64",
     *          minimum=1
     *      ),
     *  ),
	 * 	@OA\Response(
     *		response=200,
     *		description="Show Category",
     *		@OA\JsonContent(
     *		    ref="#/components/schemas/CategorySchema",
     *          example={"response": {
     *              "data":{
     *                 "id": 2,
     *                 "parent_id": "1",
     *                 "order": null,
     *                 "name": "Computadoras",
     *                 "image": "",
     *                 "note": "Pre-Registro",
     *                 "is_active": "1",
     *                 "is_deleted": "0",
     *                 "created_at": "2021-06-30T00:21:57.000000Z",
     *                 "updated_at": "2021-06-30T00:21:57.000000Z",
     *                 "parent": {
     *                     "id": 1,
     *                     "parent_id": null,
     *                     "order": null,
     *                     "name": "Electronica",
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
    public function show( $id, Request $request )
    {
        //
        $data = Category::with( 'parent' )->where( 'is_active', true )->where( 'is_deleted', false )->where( 'id', $id )->firstOrFail(  );

		if ( $request->wantsJson(  ) ) {
			return $data;
            //return $data->toJson(  );
		}
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\PUT(
     * 	path="/api/categories",
     *  operationId="update",
     * 	summary="Update Category Method",
     * 	tags={"Categories"},
     * @OA\Parameter(
     *      name="id",
     *      in="path",
     *      description="Category ID",
     *      required=true,
     *      @OA\Schema(
     *          type="integer",
     *          format="int64",
     *          minimum=1
     *      ),
     * ),
     * @OA\Parameter(
     *      name="parent_id",
     *      in="query",
     *      description="Write the parent ID",
     *      required=false,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="order",
     *      in="query",
     *      description="Write the order number",
     *      required=false,
     *      @OA\Schema(
     *          type="integer",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="name",
     *      in="query",
     *      description="Write the category's name",
     *      required=true,
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
     *      description="Write category's description",
     *      required=false,
     *      @OA\Schema(
     *          type="string",
     *      ),
     *      style="form"
     *  ),
     * 	@OA\Response(
     * 		response=201,
     *		description="Update Category",
     *		@OA\JsonContent(
     *		    ref="#/components/schemas/CategorySchema",
     *          example={"response": {
     *              "data":{
     *                 "id": 2,
     *                 "parent_id": "1",
     *                 "order": null,
     *                 "name": "Computadoras",
     *                 "image": "",
     *                 "note": "Pre-Registro",
     *                 "is_active": "1",
     *                 "is_deleted": "0",
     *                 "created_at": "2021-06-30T00:21:57.000000Z",
     *                 "updated_at": "2021-06-30T00:21:57.000000Z",
     *                 "parent": {
     *                     "id": 1,
     *                     "parent_id": null,
     *                     "order": null,
     *                     "name": "Electronica",
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
        $data = Category::with( 'parent' )->where( 'id', $id )->firstOrFail(  );
        // Validate incoming request
        $this->validate( $request, [
            'parent_id' => 'nullable|numeric',
            'order' => 'nullable|numeric',
            'name' => 'required|string|max:100',
            'image' => 'nullable|string|max:250',
            'note' => 'nullable|string|max:250'
        ] );

        $current_time = new \DateTime(  );
        try {

            $data->fill( [
                'parent_id' => $request->input( 'parent_id' ),
                'order' => $request->input( 'order' ),
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
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    /**
	 * @OA\DELETE(
     * 	path="/api/categories/{id}",
     *  operationId="destroy",
     * 	summary="Delete Category",
	 * 	tags={"Categories"},
     *  @OA\Parameter(
     *      name="id",
     *      in="path",
     *      description="Category ID",
     *      required=true,
     *      @OA\Schema(
     *          type="integer",
     *          format="int64",
     *          minimum=1
     *      ),
     *  ),
	 * 	@OA\Response(
     *		response=200,
     *		description="Delete Category",
     *		@OA\JsonContent(
     *		    ref="#/components/schemas/CategorySchema",
     *          example={"response": {
     *              "data":{
     *                 "id": 2,
     *                 "parent_id": "1",
     *                 "order": null,
     *                 "name": "Computadoras",
     *                 "image": "",
     *                 "note": "Pre-Registro",
     *                 "is_active": "1",
     *                 "is_deleted": "0",
     *                 "created_at": "2021-06-30T00:21:57.000000Z",
     *                 "updated_at": "2021-06-30T00:21:57.000000Z",
     *                 "parent": {
     *                     "id": 1,
     *                     "parent_id": null,
     *                     "order": null,
     *                     "name": "Electronica",
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
        $data = Category::with( 'parent' )->findOrFail( $id );
        $data->is_deleted = true;
        $data->save(  );

        if ( $request->wantsJson(  ) ) {
            return $data;
            //return $data->toJson(  );
        }
    }

    /**
	 * @OA\POST(
     * 	path="/api/categories/search",
     *  operationId="search",
     * 	summary="Search a Category",
	 * 	tags={"Categories"},
     * @OA\Parameter(
     *      name="parent_id",
     *      in="query",
     *      description="Write the parent ID",
     *      required=false,
     *      @OA\Schema(
     *          type="integer",
     *      ),
     *      style="form"
     *  ),
     * @OA\Parameter(
     *      name="name",
     *      in="query",
     *      description="Write the Category's name",
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
     *		description="Search categories",
     *		@OA\JsonContent(
     *		    ref="#/components/schemas/CategorySchema",
     *           example={"response": {
     *              "data":{
     *                 "id": 2,
     *                 "parent_id": "1",
     *                 "order": null,
     *                 "name": "Computadoras",
     *                 "image": "",
     *                 "note": "Pre-Registro",
     *                 "is_active": "1",
     *                 "is_deleted": "0",
     *                 "created_at": "2021-06-30T00:21:57.000000Z",
     *                 "updated_at": "2021-06-30T00:21:57.000000Z",
     *                 "parent": {
     *                     "id": 1,
     *                     "parent_id": null,
     *                     "order": null,
     *                     "name": "Electronica",
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
     *               "first_page_url": "/api/categories/search?page=1",
     *               "last_page_url": "/api/categories/search?page=1",
     *               "path": "/api/categories/search",
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
            'parent_id' => 'nullable|number',
            'name' => 'nullable|string|max:80',
            'pagination' => 'nullable|number'
        ] );

        $categories = Category::with( 'parent' )->where( 'is_active', true )->where( 'is_deleted', false );
        if ( $request->name ) {
            $categories->where( 'name', 'LIKE', "%{$request->name}%" );
        }
        if ( $request->parent_id ) {
            $categories->where( 'parent_id', $request->parent_id );
        }
        if ( $request->paginate ) {
            return $categories->orderBy( 'name', 'ASC' )->paginate( $request->paginate );
        } else {
            return $categories->orderBy( 'name', 'ASC' )->get(  );
        }
    }

}
