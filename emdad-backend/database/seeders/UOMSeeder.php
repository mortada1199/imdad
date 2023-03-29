<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UOMSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {



        $unit_of_measuerments = [
            ["id" => 1, "name_ar" => 'حبة ', "name_en" => "Each", "symbol" => "EA", "relation" => "%", "value" => "1000", "related_unit" => 0],
            ["id" => 2, "name_ar" => 'عبوة ', "name_en" => "Bottle", "symbol" => "BO", "relation" => "%", "value" => "1000", "related_unit" => 0],
            ["id" => 3, "name_ar" => 'لتر ', "name_en" => "Litre", "symbol" => "LTR", "relation" => "%", "value" => "1000", "related_unit" => 0],
            ["id" => 4, "name_ar" => 'صندوق ', "name_en" => "Box", "symbol" => "BX", "relation" => "%", "value" => "1000", "related_unit" => 0],
            ["id" => 5, "name_ar" => 'كرتون ', "name_en" => "Carton", "symbol" => "CT", "relation" => "%", "value" => "1000", "related_unit" => 0],
            ["id" => 6, "name_ar" => 'كيس ', "name_en" => "Bag", "symbol" => "BAG", "relation" => "%", "value" => "1000", "related_unit" => 0],
            ["id" => 7, "name_ar" => 'غرام ', "name_en" => "Gram", "symbol" => "G", "relation" => "%", "value" => "1000", "related_unit" => 0],
            ["id" => 8, "name_ar" => 'كيلوغرام ', "name_en" => "Kilogram", "symbol" => "KG", "relation" => "%", "value" => "1000", "related_unit" => 0],
            ["id" => 9, "name_ar" => 'دستة ', "name_en" => "Dozen", "symbol" => "DZ", "relation" => "%", "value" => "1000", "related_unit" => 0],
            ["id" => 10, "name_ar" => 'طقم ', "name_en" => "Set", "symbol" => "SET", "relation" => "%", "value" => "1000", "related_unit" => 0],
            ["id" => 11, "name_ar" => 'عدة ', "name_en" => "Kit", "symbol" => "KIT", "relation" => "%", "value" => "1000", "related_unit" => 0],
            ["id" => 12, "name_ar" => 'حزمة ', "name_en" => "Pack", "symbol" => "PAC", "relation" => "%", "value" => "1000", "related_unit" => 0],
            ["id" => 13, "name_ar" => 'كيس ', "name_en" => "Sack", "symbol" => "SAK", "relation" => "%", "value" => "1000", "related_unit" => 0],
            ["id" => 14, "name_ar" => 'لفة ', "name_en" => "Roll", "symbol" => "RO", "relation" => "%", "value" => "1000", "related_unit" => 0],
            ["id" => 15, "name_ar" => 'زوج ', "name_en" => "Pair", "symbol" => "PR", "relation" => "%", "value" => "1000", "related_unit" => 0],

        ];
        foreach ($unit_of_measuerments as $unit_of_measuerment) {
            DB::table('unit_of_measures')->insert([
                "id" => $unit_of_measuerment['id'],
                "name_ar" => $unit_of_measuerment['name_ar'],
                "name_en" => $unit_of_measuerment['name_en'],
                "symbol" => $unit_of_measuerment['symbol'],
                "relation" => $unit_of_measuerment['relation'],
                "value" => $unit_of_measuerment['value'],
                "related_unit" => $unit_of_measuerment['related_unit'],
                "created_at" => Carbon::now(),
            ]);
        }
    }
}
