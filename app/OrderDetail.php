<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 * 	schema="OrderDetailSchema",
 * 	title="OrderDetail Model",
 * 	description="Order Detail model",
 * 	@OA\Property(
 * 		property="id", description="ID of the Detail",
 *      @OA\Schema(type="number", example=1)
 *	),
 * 	@OA\Property(
 * 		property="order_id", description="Order ID",
 *      @OA\Schema(type="number", example=1)
 *	),
 * 	@OA\Property(
 * 		property="inventory_price_id", description="Product Price ID",
 *      @OA\Schema(type="number", example=1)
 *	),
 * 	@OA\Property(
 *  	property="real_price", description="Product Price",
 *      @OA\Schema(type="number", example="0.00")
 *	),
 * 	@OA\Property(
 *  	property="has_tax", description="Product Tax Percentage",
 *      @OA\Schema(type="number", example="0.00")
 *	),
 * 	@OA\Property(
 *   	property="unit_measurement", description="Product Unit Measurement",
 *      @OA\Schema(type="varchar(250)", example="Unit")
 *	),
 * 	@OA\Property(
 *  	property="quantity", description="Quantity",
 *      @OA\Schema(type="integer", example=1)
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
class OrderDetail extends Model
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
        'order_id',
        'inventory_price_id',
        'real_price',
        'has_tax',
        'unit_measurement',
        'quantity',
        'is_active',
        'is_deleted',
        'note',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [  ];


    public function order(  )
    {
        return $this->belongsTo( Order::class, 'order_id', 'id' );
    }
    public function inventory_price(  )
    {
        return $this->belongsTo( InventoryPrice::class, 'inventory_price_id', 'id' );
    }
}
