<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 * 	schema="InventoryPriceSchema",
 * 	title="InventoryPrice Model",
 * 	description="Inventory Price model",
 * 	@OA\Property(
 * 		property="id", description="ID of the Inventory Price",
 *      @OA\Schema(type="number", example=1)
 *	),
 * 	@OA\Property(
 * 		property="inventory_id", description="Inventory ID",
 *      @OA\Schema(type="number", example=1)
 *	),
 * 	@OA\Property(
 *  	property="price", description="Product Price",
 *      @OA\Schema(type="number", example="0.00")
 *	),
 * 	@OA\Property(
 *   	property="has_tax", description="Product Tax Percentage",
 *      @OA\Schema(type="number", example="0.00")
 *	),
 * 	@OA\Property(
 *   	property="note", description="Observations",
 *      @OA\Schema(type="varchar(250)", example="Observations...")
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
class InventoryPrice extends Model
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
        'inventory_id',
        'price',
        'has_tax',
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


    public function inventory(  )
    {
        return $this->belongsTo( Inventory::class, 'inventory_id', 'id' );
    }
    public function order_details(  )
    {
        return $this->hasMany( OrderDetail::class, 'id', 'inventory_price_id' );
    }

}
