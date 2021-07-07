<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 * 	schema="PointSchema",
 * 	title="Point Model",
 * 	description="Point model",
 * 	@OA\Property(
 * 		property="id", description="ID of the Point",
 *      @OA\Schema(type="number", example=1)
 *	),
 * 	@OA\Property(
 *  	property="key", description="Point Key",
 *      @OA\Schema(type="varchar(250)", example="87312874128472")
 *	),
 * 	@OA\Property(
 *   	property="value", description="Point Value",
 *      @OA\Schema(type="double(10,2)", example="200.00")
 *	),
 * 	@OA\Property(
 *  	property="message", description="Point Message",
 *      @OA\Schema(type="varchar(250)", example="Any Text")
 *	),
 * 	@OA\Property(
 * 		property="max_uses", description="How many uses it have",
 *      @OA\Schema(type="number", example=1)
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
class Point extends Model
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
        'key',
        'value',
        'message',
        'max_uses',
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


    public function products(  )
    {
        return $this->hasMany( Inventory::class, 'point_id', 'id' );
    }

    public function users(  )
    {
        return $this->hasMany( UserPoint::class, 'point_id', 'id' );
    }
}
