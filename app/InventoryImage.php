<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 * 	schema="InventoryImageSchema",
 * 	title="InventoryImage Model",
 * 	description="Inventory Image model",
 * 	@OA\Property(
 * 		property="id", description="ID of the Inventory Image",
 *      @OA\Schema(type="number", example=1)
 *	),
 * 	@OA\Property(
 * 		property="inventory_id", description="Inventory ID",
 *      @OA\Schema(type="number", example=1)
 *	),
 * 	@OA\Property(
 *   	property="is_cover", description="Is Cover?",
 *      @OA\Schema(type="boolean", example=false)
 *	),
 * 	@OA\Property(
 *  	property="filename", description="File Name",
 *      @OA\Schema(type="varchar(250)", example="File name")
 *	),
 * 	@OA\Property(
 *   	property="name", description="Image Name",
 *      @OA\Schema(type="varchar(250)", example="Image Name")
 *	),
 * 	@OA\Property(
 *   	property="url", description="Image URL",
 *      @OA\Schema(type="varchar(250)", example="https://www...")
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
class InventoryImage extends Model
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
        'is_cover',
        'filename',
        'name',
        'url',
        'note',
        'is_active',
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
}
