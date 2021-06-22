<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 * 	schema="InventoryTagSchema",
 * 	title="InventoryTag Model",
 * 	description="Inventory Tag model",
 * 	@OA\Property(
 * 		property="id", description="ID of the Inventory Tag",
 *      @OA\Schema(type="number", example=1)
 *	),
 * 	@OA\Property(
 * 		property="inventory_id", description="Inventory ID",
 *      @OA\Schema(type="number", example=1)
 *	),
 * 	@OA\Property(
 * 		property="tag_id", description="Tag ID",
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
class InventoryTag extends Model
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
        'tag_id',
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
    public function tag(  )
    {
        return $this->belongsTo( Tag::class, 'tag_id', 'id' );
    }

}
