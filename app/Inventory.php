<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 * 	schema="InventorySchema",
 * 	title="Inventory Model",
 * 	description="Inventory model",
 * 	@OA\Property(
 * 		property="id", description="ID of the Inventory",
 *      @OA\Schema(type="number", example=1)
 *	),
 * 	@OA\Property(
 * 		property="product_id", description="Product ID",
 *      @OA\Schema(type="number", example=1)
 *	),
 * 	@OA\Property(
 * 		property="point_id", description="Point ID",
 *      @OA\Schema(type="number", example=1)
 *	),
 * 	@OA\Property(
 * 		property="company_id", description="Company ID",
 *      @OA\Schema(type="number", example=1)
 *	),
 * 	@OA\Property(
 *  	property="name", description="Inventory Name",
 *      @OA\Schema(type="varchar(250)", example="Shampoo")
 *	),
 * 	@OA\Property(
 *  	property="description", description="About the Item",
 *      @OA\Schema(type="varchar(250)", example="Shampoo Cheap")
 *	),
 * 	@OA\Property(
 *  	property="company_name", description="Company that makes the Item",
 *      @OA\Schema(type="varchar(250)", example="P&G")
 *	),
 * 	@OA\Property(
 *   	property="image", description="Inventory Image",
 *      @OA\Schema(type="varchar(250)", example="piso83digital.png")
 *	),
 * 	@OA\Property(
 *   	property="classification", description="Inventory Classification",
 *      @OA\Schema(type="varchar(250)", example="hello@piso83digital.com")
 *	),
 * 	@OA\Property(
 *   	property="code", description="Inventory Code",
 *      @OA\Schema(type="varchar(250)", example="1234567890")
 *	),
 * 	@OA\Property(
 *   	property="unit_measurement", description="Unit of Measurement",
 *      @OA\Schema(type="varchar(50)", example="Unit")
 *	),
 * 	@OA\Property(
 *   	property="qmin", description="Minimum Capacity",
 *      @OA\Schema(type="integer", example=1)
 *	),
 * 	@OA\Property(
 *   	property="qmax", description="Maximum Capacity",
 *      @OA\Schema(type="integer", example=5)
 *	),
 * 	@OA\Property(
 *   	property="existence", description="Inventory's existence",
 *      @OA\Schema(type="integer", example=5)
 *	),
 * 	@OA\Property(
 *   	property="availability", description="Inventory's availability",
 *      @OA\Schema(type="integer", example=5)
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
class Inventory extends Model
{
    //
    protected $table = 'inventories';

    protected $guarded = [  ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'product_id',
        'point_id',
        'company_id',
        'name',
        'description',
        'include',
        'company_name',
        'image',
        'classification',
        'unit_measurement',
        'code',
        'qmin',
        'qmax',
        'existence',
        'availability',
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


    public function product(  )
    {
        return $this->belongsTo( Product::class, 'product_id', 'id' );
    }
    public function point(  )
    {
        return $this->belongsTo( Point::class, 'point_id', 'id' );
    }
    public function company(  )
    {
        return $this->belongsTo( Company::class, 'company_id', 'id' );
    }
    public function prices(  )
    {
        return $this->hasMany( InventoryPrice::class, 'inventory_id', 'id' )->where( 'is_active', true );
    }
    public function images(  )
    {
        return $this->hasMany( InventoryImage::class, 'inventory_id', 'id' );
    }
    public function tags(  )
    {
        return $this->hasMany( InventoryTag::class, 'inventory_id', 'id' );
    }
}
