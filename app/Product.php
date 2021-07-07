<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 * 	schema="ProductSchema",
 * 	title="Product Model",
 * 	description="Product model",
 * 	@OA\Property(
 * 		property="id", description="ID of the Product",
 *      @OA\Schema(type="number", example=1)
 *	),
 * 	@OA\Property(
 *  	property="name", description="Product Name",
 *      @OA\Schema(type="varchar(250)", example="Service")
 *	),
 * 	@OA\Property(
 *  	property="description", description="Product Description",
 *      @OA\Schema(type="varchar(250)", example="Service")
 *	),
 * 	@OA\Property(
 *   	property="image", description="Product Image",
 *      @OA\Schema(type="varchar(250)", example="service.png")
 *	),
 * 	@OA\Property(
 *   	property="note", description="Observations",
 *      @OA\Schema(type="varchar", example="Observations...")
 *	),
 * 	@OA\Property(
 *   	property="is_active", description="Is the row active?",
 *      @OA\Schema(type="number", example=1)
 *	),
 * 	@OA\Property(
 *   	property="is_deleted", description="Is the row deleted?",
 *      @OA\Schema(type="number", example=0)
 *	),
 * 	@OA\Property(
 *   	property="created_at", description="Created",
 *      @OA\Schema(type="datetime", example="1990-01-01 00:00:00")
 *	),
 * 	@OA\Property(
 *   	property="modified_at", description="Modified",
 *      @OA\Schema(type="datetime", example="1990-01-01 00:00:00")
 *	)
 * )
 */
class Product extends Model
{
    //
    protected $guarded = [  ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'category_id',
        'name',
        'description',
        'image',
        'note',
        'is_active',
        'is_deleted',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [  ];


    public function category(  )
    {
        return $this->belongsTo( Category::class, 'category_id', 'id' );
    }
    public function inventories(  )
    {
        return $this->hasMany( Inventory::class, 'product_id', 'id' );
    }

}
