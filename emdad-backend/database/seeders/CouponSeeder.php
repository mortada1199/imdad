<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $coupons = [
             ['code'=>rand(100,99),'value'=>rand(100,99), 'is_percentage'=>0, 'start_date'=>'2025-1-1', 'end_date'=>'2026-1-1','allowed'=>100,'used'=>0] ,
             ['code'=>rand(1000,999),'value'=>rand(1000,999), 'is_percentage'=>0, 'start_date'=>'2025-1-1', 'end_date'=>'2026-1-1','allowed'=>100,'used'=>0] ,
             ['code'=>rand(10000,9999),'value'=>rand(10000,9999), 'is_percentage'=>0, 'start_date'=>'2025-1-1', 'end_date'=>'2026-1-1','allowed'=>100,'used'=>0] 
       
            ];
        
        foreach ($coupons as $coupon) {
            
            DB::table('coupons')->insert([
                "code" => $coupon['code'],
                "value" => $coupon['value'],
                "is_percentage" => $coupon['is_percentage'],
                "start_date" => $coupon['start_date'],
                "end_date" => $coupon['end_date'],
                "allowed" => $coupon['allowed'],
                "used" => $coupon['used']
            ]);
        }
    }
    
}
