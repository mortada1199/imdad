<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Accounts\SubscriptionPackages;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
class ApiKeysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $apikeys = [["id"=>"1" , "name"=>"key" , "key"=>"Rmkmb7wG8p5xOEo0hlS2DhxHL71HsuT3Y8TSNDhoYDwFSp8L9gniikitjNeBwPQK","active"=>"1"]];
        foreach ($apikeys as $key) {
            DB::table('api_keys')->insert([
                'id' => $key['id'],
                'name' => $key['name'],
                'key' => $key['key'],
                'active' => $key['active']
            ]);
        }
    }
}
