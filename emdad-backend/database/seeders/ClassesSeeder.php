<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Settings\VechileClass;
use Illuminate\Support\Facades\DB;

class ClassesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $names = ['name_en'=>'','name_ar'=>''];

        foreach ($names as $name) {
            DB::table('vehicle_classes')->insert([
                "name_en" => $name["name_en"],
                "name_ar" => $name["name_ar"],
            ]);
        }
    }
}
