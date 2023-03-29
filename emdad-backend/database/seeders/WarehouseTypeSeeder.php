<?php

namespace Database\Seeders;

use App\Models\WarehouseType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WarehouseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            ['name_en'=>'Dry closed warehouse','name_ar'=>'مستودع مغلق جاف'],
            ['name_en'=>'Dry opened warehouse','name_ar'=>'مستودع جاف مفتوح'],
            ['name_en'=>'Cold closed warehouse','name_ar'=>'مستودع مغلق بارد'],
        ];

        foreach ($types as $type) {
            WarehouseType::create([
                "name_en" => $type["name_en"],
                "name_ar" => $type["name_ar"],
            ]);
           
        }
    }
}
