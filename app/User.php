<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Facades\Mail;

/**
 * @OA\Schema(
 * 	schema="UserSchema",
 * 	title="User Model",
 * 	description="User model",
 * 	@OA\Property(
 * 		property="id", description="ID of the Company",
 *      @OA\Schema(type="number", example=1)
 *	),
 * 	@OA\Property(
 * 		property="company_id", description="ID of the user",
 *      @OA\Schema(type="number", example=1)
 *	),
 * 	@OA\Property(
 *  	property="first_name", description="First Name",
 *      @OA\Schema(type="varchar(60)", example="Néstor Alberto")
 *	),
 * 	@OA\Property(
 *  	property="last_name", description="Last Name",
 *      @OA\Schema(type="varchar(60)", example="Molina Moran")
 *	),
 * 	@OA\Property(
 *  	property="partner_number", description="Partner Number",
 *      @OA\Schema(type="integer", example=007)
 *	),
 * 	@OA\Property(
 *  	property="company_name", description="Company Name",
 *      @OA\Schema(type="varchar(250)", example="Piso 83 Digital")
 *	),
 * 	@OA\Property(
 *  	property="birthday", description="User's birthday",
 *      @OA\Schema(type="date", example="1900-01-01")
 *	),
 * 	@OA\Property(
 *  	property="gender", description="User's Gender",
 *      @OA\Schema(type="tinyInteger", example=0)
 *	),
 * 	@OA\Property(
 *   	property="username", description="Username of the user",
 *      @OA\Schema(type="varchar(50)", example="nmolina")
 *	),
 * 	@OA\Property(
 *   	property="email", description="Email of the user",
 *      @OA\Schema(type="varchar(60)", example="alberto@piso83digital.com")
 *	),
 * 	@OA\Property(
 *   	property="email_verified_at", description="Email Verification DateTime",
 *      @OA\Schema(type="datetime", example="1990-01-01 00:00:00")
 *	),
 * 	@OA\Property(
 *   	property="phone", description="Phone number of the user",
 *      @OA\Schema(type="varchar(35)", example="72906930")
 *	),
 * 	@OA\Property(
 *   	property="country", description="User's Country",
 *      @OA\Schema(type="varchar(50)", example="Costa Rica.")
 *	),
 * 	@OA\Property(
 *   	property="province", description="User's Province",
 *      @OA\Schema(type="varchar(50)", example="San Jose.")
 *	),
 * 	@OA\Property(
 *   	property="canton", description="User's Canton",
 *      @OA\Schema(type="varchar(50)", example="Santa Ana.")
 *	),
 * 	@OA\Property(
 *   	property="district", description="User's District",
 *      @OA\Schema(type="varchar(50)", example="Brasil.")
 *	),
 * 	@OA\Property(
 *   	property="address", description="Address of the user",
 *      @OA\Schema(type="varchar(250)", example="San Jose, Costa Rica.")
 *	),
 * 	@OA\Property(
 *   	property="zip", description="User's ZIP Code",
 *      @OA\Schema(type="varchar(10)", example="10906")
 *	),
 * 	@OA\Property(
 *   	property="points", description="User Points",
 *      @OA\Schema(type="integer", example=1)
 *	),
 * 	@OA\Property(
 *   	property="image", description="Company Image",
 *      @OA\Schema(type="varchar(250)", example="piso83digital.png")
 *	),
 * 	@OA\Property(
 *   	property="note", description="Observations",
 *      @OA\Schema(type="varchar", example="Observations...")
 *	),
 * 	@OA\Property(
 *   	property="is_admin", description="Is the user admin?",
 *      @OA\Schema(type="number", example=1)
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
 *   	property="password", description="Password of the user",
 *      @OA\Schema(type="varchar(64)", example="*****")
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
class User extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject, CanResetPasswordContract
{
    use Authenticatable, Authorizable;
    use Notifiable, CanResetPassword;

    const ADMIN_TYPE = 1;
    const DEFAULT_TYPE = 0;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'company_id',
        'first_name',
        'last_name',
        'username',
        'email',
        'email_verified_at',
        'phone',
        'gender',
        'partner_number',
        'company_name',
        'birthday',
        'country',
        'province',
        'canton',
        'district',
        'zip',
        'address',
        'points',
        'image',
        'token',
        'is_admin',
        'password',
        'note',
        'is_active',
        'is_deleted',
        'created_at',
        'updated_at',
    ];

    public function company(  )
    {
        return $this->belongsTo( Company::class, 'company_id', 'id' );
    }

    public function orders(  )
    {
        return $this->hasMany( Order::class, 'client_id', 'id' );
    }

    public function points(  )
    {
        return $this->hasMany( UserPoint::class, 'user_id', 'id' );
    }

    public function isAdmin(  ) {
        return $this->is_admin == self::ADMIN_TYPE;
    }

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token'
    ];
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier(  )
    {
        return $this->getKey(  );
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims(  )
    {
        return [  ];
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword(  )
    {
        return $this->password;
    }

    public function sendPasswordResetNotification($token){
        // $this->notify(new MyCustomResetPasswordNotification($token)); <--- remove this, use Mail instead like below

        $data = [
            $this->email
        ];

        Mail::send('mails.reset-password', [
            'fullname'      => $this->first_name . ' ' . $this->last_name,
            'reset_url'     => env('CLIENT_URL') . '/restablecer-password?token' . $token . '&email' . $this->email,
        ], function($message) use($data){
            $message->subject('Solicitud para restableces contraseña');
            $message->to($data[0]);
        });
    }
}
