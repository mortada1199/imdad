<?php

namespace App\Models;

use App\Models\Accounts\Warehouse;
use App\Models\Settings\Setting;
use App\Models\UM\Role;
use App\Models\UM\RoleUserProfile;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens as SanctumHasApiTokens;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends  Authenticatable implements HasMedia, MustVerifyEmail
{
    use SanctumHasApiTokens, Notifiable, HasFactory, SoftDeletes, LogsActivity, InteractsWithMedia;

    protected $dates = ['deleted_at'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'full_name',
        'identity_type', 'email', 'password', 'identity_number',
        'is_verified', 'profile_id', 'avatar', 'otp', 'is_super_admin',
        'otp_expires_at', 'mobile',  'expiry_date', 'lang', 'password_changed'
    ];


    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower($value);
    }


    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash("sha256",$value);
    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'role_id' => 'integer',
    ];

    public function oauthAccessToken()
    {
        return $this->hasMany('\App\Models\UM\OauthAccessToken');
    }

    // public function roles()
    // {
    //     return $this->belongsToMany(RoleUserProfile::class,'user_id');
    // }



    public function currentProfile()
    {
        return Profile::where("id", $this->profile_id)->select(["name_ar", 'active', 'subscription_details', 'cr_expire_data', 'subs_id', 'iban', 'swift', 'created_by', 'type', 'id'])->first();
    }

    public function userStatus()
    {
        return RoleUserProfile::where("profile_id", $this->profile_id)->where("user_id", $this->id)->first();
    }

    public function userRole()
    {
        return RoleUserProfile::where('profile_id', $this->profile_id)->where("user_id", $this->id)->pluck('role_id')->first();
    }


    public function roleInProfile()
    {
        return $this->belongsToMany(Role::class, 'profile_role_user', 'user_id', 'role_id', 'created_by')
            ->withPivot('profile_id')
            ->withTimestamps();
    }

    // public function exists($roleId, $profileId)
    // {
    //     return $this->belongsToMany(Role::class, 'profile_role_user', 'user_id', 'role_id')
    //         ->wherePivot('role_id', $roleId)
    //         ->wherePivot('profile_id', $profileId)
    //         ->first();
    // }



    public function warehouses()
    {
        return $this->belongsToMany(Warehouse::class);
    }



    // public function profiles()
    // {
    //     return $this->belongsToMany(
    //         Profile::class,
    //         'profile_department_user'
    //     )->withPivot('department_id')
    //         ->withTimestamps();
    // }
    public function departments()
    {
        return $this->belongsToMany(
            Department::class,
            'profile_department_user'
        )->withPivot('profile_id')
            ->withTimestamps();
    }



    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function oldOwner()
    {
        $count = SubscriptionPayment::where('user_id', auth()->id())->where('status', "Paid")->count();
        if ($count > 0) {
            return true;
        }
        return false;
    }


    public function checkUserRole($user_id, $profile_id = null)
    {

        if ($profile_id != null) {
            $count =  RoleUserProfile::where('user_id', $user_id)->where('profile_id', $profile_id)->count();
            if ($count > 0)
                return true;
        } else {
            $count =  RoleUserProfile::where('user_id', $user_id)->count();
            if ($count > 0)
                return true;
        }
        return false;
    }

    public function mangerUserId()
    {
        // CHECK MANGER FOR THE USER
        $mangerId = DB::table('profile_role_user')->where('user_id', $this->id)->where('profile_id', auth()->user()->profile_id ?? null)->pluck('manager_user_Id')->first();

        //send mangerId to Manger name 
        $mangerName = $this->mangerName($mangerId);

        //return manger info
        return ["mangerID" => $mangerId, "mangerName" => $mangerName];
    }

    //get manger name
    public function mangerName($mangerId)
    {
        return DB::table('users')->where('id', $mangerId)->pluck('full_name')->first();
    }

    // user roles
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'profile_role_user')
            ->withPivot(['role_id', 'status','is_learning','permissions'])
            ->as('role');
    }

    //user profiles
    public function profiles()
    {
        return $this->belongsToMany(Profile::class, 'profile_role_user')
            ->withPivot(['profile_id', 'status'])
            ->as('profile')
            ->withTimestamps();
    }

    public  function crNumbersList()
    {
        $profileIds = DB::table('profile_role_user')->where('user_id', $this->id)->pluck('profile_id');
        $crNumbersList=[];
        for($i=0;$i<count($profileIds);$i++)
        {
            $profile = Profile::find($profileIds[$i]);
            $crNumbersList[$profile->id] = intval($profile->cr_number);
        }

        return $crNumbersList;
    }

   
}
