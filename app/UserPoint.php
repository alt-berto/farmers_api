<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 * 	schema="UserPointSchema",
 * 	title="UserPoint Model",
 * 	description="User Point model",
 * 	@OA\Property(
 * 		property="id", description="ID of the User Point",
 *      @OA\Schema(type="number", example=1)
 *	),
 * 	@OA\Property(
 * 		property="user_id", description="User ID",
 *      @OA\Schema(type="number", example=1)
 *	),
 * 	@OA\Property(
 * 		property="point_id", description="Point ID",
 *      @OA\Schema(type="number", example=1)
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
class UserPoint extends Model
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
        'user_id',
        'point_id',
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


    public function user(  )
    {
        return $this->belongsTo( User::class, 'user_id', 'id' );
    }
    public function point(  )
    {
        return $this->belongsTo( Point::class, 'point_id', 'id' );
    }

}
