<?php

namespace Database\Seeders;

// use App\Models\Emdad\Categories;
use App\Models\Emdad\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        $csvFile = fopen(base_path("database/data/categories.csv"), "r");

  

        $firstline = true;

        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {

            if (!$firstline) {

                Category::create([
                    'id' => $data[0],
                    'name_ar' => $data[2],
                    'name_en' => $data[1],
                    'parent_id' => $data[4],
                    'isleaf' => $data[5],
                    'status' => $data[3],
                    'type' => $data[11],
                ]);

            }

            $firstline = false;

        }

   

        fclose($csvFile);
        // foreach ($Categories as $Category) {
        //     Category::create([
        //         'id' => $Category['id'],
        //         'name_ar' => $Category['name_ar'],
        //         'name_en' => $Category['name_en'],
        //         'parent_id' => $Category['parent_id'],
        //         'isleaf' => $Category['isleaf'],
        //         'status' => $Category['status'],
        //         'type' => $Category['type'],
        //     ]);
        // }
    }
}
