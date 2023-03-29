<?php

namespace App\Models;

use App\Models\Accounts\SubscriptionPackages;
// use App\Models\Emdad\Categories;
use App\Models\Emdad\Category;
use App\Models\Emdad\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Profile extends Model implements HasMedia
{
    use HasFactory, SoftDeletes,InteractsWithMedia;

    protected $fillable = [
        'created_by',
        'name_ar',
        'name_en',
        'swift',
        'iban',
        'type',
        'bank',
        'vat_number',
        'cr_number',
        'cr_expire_data',
        'subs_id',
        'subscription_details',
        'active',
    ];

    public function wallet()
    {
        return $this->morphOne(Wallet::class, 'accountable');
    }

    public function trucks()
    {
        return $this->morphMany(Truck::class, 'manageable');
    }

    public function drivers()
    {
        return $this->morphMany(Driver::class, 'manageable');
    }

    // public function products()
    // {
    //     return $this->hasMany(Product::class);
    // }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function parent()
    {
        return $this->belongsTo(Profile::class, 'parent_id');
    }

    public function subscriptions()
    {
        return $this->morphMany(Subscription::class, 'subscribed');
    }


    public function subscriptionPayments()
    {
        return $this->hasMany(SubscriptionPayment::class);
    }

    // public function users()
    // {
    //     return $this->belongsToMany(
    //         User::class,
    //         'profile_department_user'
    //     )->withPivot('department_id')
    //         ->withTimestamps();;
    // }
    public function departments()
    {
        return $this->belongsToMany(
            Department::class,
            'profile_department_user'
        )->withPivot('user_id')
            ->withTimestamps();;
    }
    public function creatorName()
    {
        return User::where('id',$this->created_by)->first();
        
    }

    //profile users
    public function users()
    {
        return $this->belongsToMany(User::class, 'profile_role_user')
        ->withPivot(['user_id', 'status'])
        ->as('user');
    }

    //profile roles
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'profile_role_user')
        ->withPivot(['role_id', 'status'])
        ->as('role');
    }
}
