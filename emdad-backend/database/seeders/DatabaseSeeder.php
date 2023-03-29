<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Accounts\SubscriptionPackages;
use App\Models\AppSetting;
use App\Models\Coupon\Coupon;
use App\Models\Emdad\Category;
use App\Models\Emdad\RelatedCompanies;
use App\Models\Emdad\Unit_of_measures;
use App\Models\UM\Permission;
use App\Models\UM\Role;
use App\Models\User;
use App\Models\WarehouseType;
use Ejarnutowski\LaravelApiKey\Models\ApiKey;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        DB::table('categories')->delete();
        DB::table('permissions')->delete();
        DB::table('app_settings')->delete();
        DB::table('roles')->delete();

        if (ApiKey::count() == 0) {
            $this->call([
                ApiKeysSeeder::class
            ]);
        }

        if (SubscriptionPackages::count() == 0) {
            $this->call([
                SubscriptionPackagesSeeder::class
            ]);
        }

        if (Permission::count() == 0) {
            $this->call([
                PermissionSeeder::class
            ]);
        }
        if (Unit_of_measures::count() == 0) {
            $this->call([
                UOMSeeder::class
            ]);
        }

        if (Role::count() == 0) {

            $this->call([
                RegRoleSeeder::class
            ]);
        }
        if(Category::count()==0){
            $this->call([
                CategoriesSeeder::class
            ]);
        }
        if (RelatedCompanies::count() == 0) {
            $this->call([
                RelatedCompinesTableSeeder::class
            ]);
        }

        if (User::count() == 0) {
            $this->call([
                UserSeeder::class
            ]);
        }
        if(Coupon::count()==0){
            $this->call([
                CouponSeeder::class]);
        }

        if(AppSetting::count()==0){
            $this->call([
                SettingsSeeder::class]);
        }

        if(WarehouseType::count()==0){
            $this->call([
                WarehouseTypeSeeder::class]);
        }


        //test again
    }
}
