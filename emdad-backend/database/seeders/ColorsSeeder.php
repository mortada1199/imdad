<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Settings\Color;

use Illuminate\Support\Facades\DB;

class ColorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $names =[
            ['name_en'=>'Black','name_ar'=>'اسود'],
            ['name_en'=>'white','name_ar'=>'ابيض'],
            ['name_en'=>'Blue','name_ar'=>'ازرق'],
            ['name_en'=>'Yellow','name_ar'=>'أصفر'],
            ['name_en'=>'Green','name_ar'=>'اخضر'],
            ['name_en'=>'Grey','name_ar'=>'رمادي']
        ];

        foreach ($names as $name) {
            DB::table('colors')->insert([
                "name_en" => $name["name_en"],
                "name_ar" => $name["name_ar"],
            ]);
        }
    }
}
