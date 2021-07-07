<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 * 	schema="OrderSchema",
 * 	title="Order Model",
 * 	description="Order model",
 * 	@OA\Property(
 * 		property="id", description="ID of the Order",
 *      @OA\Schema(type="number", example=1)
 *	),
 * 	@OA\Property(
 * 		property="client_id", description="Client ID",
 *      @OA\Schema(type="number", example=1)
 *	),
 * 	@OA\Property(
 *  	property="card_info", description="Card Info",
 *      @OA\Schema(type="varchar(250)", example="Text")
 *	),
 * 	@OA\Property(
 *  	property="card_name", description="Card Name",
 *      @OA\Schema(type="varchar(250)", example="Text")
 *	),
 * 	@OA\Property(
 *   	property="last_digit_card", description="Card Last Digits",
 *      @OA\Schema(type="integer", example="1234")
 *	),
 * 	@OA\Property(
 *  	property="session", description="User Session",
 *      @OA\Schema(type="varchar(250)", example="1341h3h42g2423jh4g2g")
 *	),
 * 	@OA\Property(
 *   	property="note", description="Observations",
 *      @OA\Schema(type="varchar(250)", example="Observations...")
 *	),
 * 	@OA\Property(
 *   	property="state", description="Order's State",
 *      @OA\Schema(type="enum", example="pending")
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
class Order extends Model
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
        'client_id',
        'card_info',
        'card_name',
        'last_digit_card',
        'session',
        'note',
        'state',
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


    public function user(  )
    {
        return $this->belongsTo( User::class, 'client_id', 'id' );
    }
    public function details(  )
    {
        return $this->hasMany( OrderDetail::class, 'order_id', 'id' );
    }
}
