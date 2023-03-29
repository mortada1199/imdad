<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Settings\VechileSize;
use Illuminate\Support\Facades\DB;

class SizesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $names = [
            ['name_en'=>'Light duty','name_ar'=>'خفيفة'],
            ['name_en'=>'Medium duty ','name_ar'=>'متوسطة'],
            ['name_en'=>'Heavy duty','name_ar'=>'ثقيلة'],
        ];

        foreach ($names as $name) {
            DB::table('vehicle_sizes')->insert([
                "name_en" => $name["name_en"],
                "name_ar" => $name["name_ar"],
            ]);
        }
    }
}
