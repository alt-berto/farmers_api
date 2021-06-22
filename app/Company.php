<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 * 	schema="CompanySchema",
 * 	title="Company Model",
 * 	description="Company model",
 * 	@OA\Property(
 * 		property="id", description="ID of the Company",
 *      @OA\Schema(type="number", example=1)
 *	),
 * 	@OA\Property(
 * 		property="identification_type", description="Identification type",
 *      @OA\Schema(type="varchar(2)", example="01")
 *	),
 * 	@OA\Property(
 *  	property="legal_id", description="First Name",
 *      @OA\Schema(type="varchar(16)", example="123456789")
 *	),
 * 	@OA\Property(
 *  	property="name", description="Company Name",
 *      @OA\Schema(type="varchar(250)", example="Piso 83")
 *	),
 * 	@OA\Property(
 *  	property="business_name", description="Company Business Name",
 *      @OA\Schema(type="varchar(250)", example="Piso 83 Digital")
 *	),
 * 	@OA\Property(
 *  	property="description", description="About the Company",
 *      @OA\Schema(type="varchar(250)", example="About the company text")
 *	),
 * 	@OA\Property(
 *   	property="email", description="Email of the Company",
 *      @OA\Schema(type="varchar(60)", example="hello@piso83digital.com")
 *	),
 * 	@OA\Property(
 *   	property="phone", description="Phone number of the Company",
 *      @OA\Schema(type="varchar(12)", example="60061983")
 *	),
 * 	@OA\Property(
 *   	property="country", description="Company's Country",
 *      @OA\Schema(type="varchar(50)", example="Costa Rica.")
 *	),
 * 	@OA\Property(
 *   	property="province", description="Company's Province",
 *      @OA\Schema(type="varchar(50)", example="San Jose.")
 *	),
 * 	@OA\Property(
 *   	property="canton", description="Company's Canton",
 *      @OA\Schema(type="varchar(50)", example="Santa Ana.")
 *	),
 * 	@OA\Property(
 *   	property="district", description="Company's District",
 *      @OA\Schema(type="varchar(50)", example="Brasil.")
 *	),
 * 	@OA\Property(
 *   	property="address", description="Address of the Company",
 *      @OA\Schema(type="varchar(250)", example="San Jose, Costa Rica.")
 *	),
 * 	@OA\Property(
 *   	property="website", description="Company Website",
 *      @OA\Schema(type="varchar(250)", example="https://www.piso83digital.com")
 *	),
 * 	@OA\Property(
 *   	property="image", description="Company Image",
 *      @OA\Schema(type="varchar(250)", example="piso83digital.png")
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
class Company extends Model
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
        'identification_type',
        'legal_id',
        'name',
        'business_name',
        'description',
        'email',
        'phone',
        'country',
        'province',
        'canton',
        'district',
        'address',
        'website',
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

    public function users(  )
    {
        return $this->hasMany( User::class, 'id', 'company_id' );
    }

    public function inventories(  )
    {
        return $this->hasMany( Inventory::class, 'id', 'company_id' );
    }
}
