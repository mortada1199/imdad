<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //comment User seed
        $users = [
            [
                'id' => 1,
                'email' => 'ahmed1@email.com',
                'password' => "Passw0rd!",
                'created_at' => now(),
                'is_verified' => true,
                'is_admin' => true,
                'full_name' => 'ahmed alkhatim',
                'identity_number' => '1234567891',
                'identity_type' => 'nid',
                'password_changed' => true,
                'mobile' => '00966123456789',
                'profile_id' => 1
            ],
            [
                'id' => 2,
                'email' => 'ahmed2@email.com',
                'password' => "Passw0rd!",
                'created_at' => now(),
                'is_verified' => true, 'created_at' => now(),
                'is_admin' => true, 'created_at' => now(),
                'full_name' => 'ahmed alkhatim 2',
                'identity_number' => '1234567892',
                'identity_type' => 'nid',
                'password_changed' => true, 'created_at' => now(),
                'mobile' => '00966123456782',
                'profile_id' => 2
            ],
            [
                'id' => 3,
                'email' => 'ahmed3@email.com',
                'password' => "Passw0rd!",
                'created_at' => now(),
                'is_verified' => true, 'created_at' => now(),
                'is_admin' => true, 'created_at' => now(),
                'full_name' => 'ahmed alkhatim 3',
                'identity_number' => '1234567893',
                'identity_type' => 'nid',
                'password_changed' => true, 'created_at' => now(),
                'mobile' => '00966123456783',
                'profile_id' => 3

            ],
            [
                'id' => 4,
                'email' => 'ahmed4@email.com',
                'password' => "Passw0rd!",
                'created_at' => now(),
                'is_verified' => true, 'created_at' => now(),
                'is_admin' => true, 'created_at' => now(),
                'full_name' => 'ahmed alkhatim 4',
                'identity_number' => '1234567894',
                'identity_type' => 'nid',
                'password_changed' => true, 'created_at' => now(),
                'mobile' => '00966123456784',
                'profile_id' => 4

            ],
            [
                'id' => 5,
                'email' => 'ahmed5@email.com',
                'password' => "Passw0rd!",
                'created_at' => now(),
                'is_verified' => true, 'created_at' => now(),
                'is_admin' => true, 'created_at' => now(),
                'full_name' => 'ahmed alkhatim 5',
                'identity_number' => '1234567895',
                'identity_type' => 'nid',
                'password_changed' => true, 'created_at' => now(),
                'mobile' => '00966123456785',
                'profile_id' => 5
            ],   [
                'id' => 6,
                'email' => 'ahmed6@email.com',
                'password' => "Passw0rd!",
                'created_at' => now(),
                'is_verified' => true, 'created_at' => now(),
                'is_admin' => true, 'created_at' => now(),
                'full_name' => 'ahmed alkhatim 6',
                'identity_number' => '1234567896',
                'identity_type' => 'nid',
                'password_changed' => true, 'created_at' => now(),
                'mobile' => '00966123456786',
                'profile_id' => 6

            ]
        ];

        // profiles seed
        $profiles = [
            [
                'id' => 1,
                'created_by' => 1,
                'name_ar' => 'شركه احمد التقنيه',
                'name_en' => 'Ahmed comany co.ltd',
                'swift' => rand(1000, 999),
                'iban' => rand(10000, 9999),
                'type' => 'Buyer',
                'bank' => 'khartoum Banck',
                'vat_number' => 15,
                'cr_number' => 1,
                'cr_expire_data' => '2025-1-1',
                'subs_id' => 1,
                'subscription_details',
                'active' => true, 'created_at' => now()
            ],
            [
                'id' => 2,
                'created_by' => 2,
                'name_ar' => 'شركه احمد القابطة',
                'name_en' => 'Ahmed Holding Company co.ltd',
                'swift' => rand(1000, 999),
                'iban' => rand(10000, 9999),
                'type' => 'Supplier',
                'bank' => 'Nile Banck',
                'vat_number' => 15,
                'cr_number' => 2,
                'cr_expire_data' => '2025-1-1',
                'subs_id' => 2,
                'subscription_details',
                'active' => true, 'created_at' => now()
            ],
            [
                'id' => 3,
                'created_by' => 3,
                'name_ar' => 'شركه احمد للتجاره',
                'name_en' => 'Ahmed Trading Company',
                'swift' => rand(1000, 999),
                'iban' => rand(10000, 9999),
                'type' => 'Buyer',
                'bank' => 'Omdurman Banck',
                'vat_number' => 15,
                'cr_number' => 3,
                'cr_expire_data' => '2025-1-1',
                'subs_id' => 3,
                'subscription_details',
                'active' => true, 'created_at' => now()
            ],
            [
                'id' => 4,
                'created_by' => 4,
                'name_ar' => 'شركه احمد للاستيراد',
                'name_en' => 'Ahmed to import Company',
                'swift' => rand(1000, 999),
                'iban' => rand(10000, 9999),
                'type' => 'Supplier',
                'bank' => 'Tdaman Banck',
                'vat_number' => 15,
                'cr_number' => 4,
                'cr_expire_data' => '2025-1-1',
                'subs_id' => 4,
                'subscription_details',
                'active' => true,
                'created_at'=>now()
            ],
            [
                'id' => 5,
                'created_by' => 5,
                'name_ar' => 'شركه احمد للتصدير',
                'name_en' => 'Ahmed to export Company',
                'swift' => rand(1000, 999),
                'iban' => rand(10000, 9999),
                'type' => 'Buyer',
                'bank' => 'lorem Banck',
                'vat_number' => 15,
                'cr_number' => 5,
                'cr_expire_data' => '2025-1-1',
                'subs_id' => 5,
                'subscription_details',
                'active' => true, 'created_at' => now()
            ],
            [
                'id' => 6,
                'created_by' => 6,
                'name_ar' => 'شركه احمد للمقاولات',
                'name_en' => 'Ahmed to Contracting Company',
                'swift' => rand(1000, 999),
                'iban' => rand(10000, 9999),
                'type' => 'Supplier',
                'bank' => 'Tdaman Banck',
                'vat_number' => 15,
                'cr_number' => 6,
                'cr_expire_data' => '2025-1-1',
                'subs_id' => 6,
                'subscription_details',
                'active' => true, 'created_at' => now()
            ],
        ];

        $allBuyerPermissipns = ["BR1", "BR2", "BR3", "BQ1", "BQ2", "BQ3", "BP1", "BP2", "BP3", "BI1", "BI2", "BD1", "BD2", "BMCD4", "BMCD3", "BMCD2", "BMCD1", "BMU4", "BMU3", "BMU2", "BMU1", "BML2", "BML1", "BMCO3", "BMCO2", "BMCO1", "BMCT2", "BMCT1", "BMNM2", "BMNM1", "BMCA2", "BMMB2", "BMMB1", "BMCD1", "BMCT2", "BMCT1", "BMDE2", "BMDE1"];
        $allSupplierPermissions = ["SRFQ3", "SRFQ2", "SRFQ1", "SQ3", "SQ2", "SQ1", "SPO2", "SPO1", "SCL1", "SCR3", "SCR2", "SCR1", "SDD4", "SDD3", "SDD2", "SDD1", "SAP3", "SAP2", "SAP1", "SMCS5", "SMCS4", "SMCS3", "SMCS2", "SMCS1", "SMU4", "SMU3", "SMU2", "SMU1", "SML2", "SML1", "SMC3", "SMC2", "SMC1", "SMCT2", "SMCT1", "SMUP2", "SMUP1", "SMCD1", "SMAL1", "SMMB2", "SMMB1", "SMFL4", "SMFL3", "SMFL2", "SMFL1", "SMAP2", "SMAP1"];
        $rolesUsersProfiles = [
            ['id' => 1, 'role_id' => 1, 'user_id' => 1, 'profile_id' => 1, 'created_by' => 1, 'permissions' => json_encode($allBuyerPermissipns, true), 'created_at' => now()],
            ['id' => 2, 'role_id' => 1, 'user_id' => 2, 'profile_id' => 2, 'created_by' => 2, 'permissions' => json_encode($allSupplierPermissions, true), 'created_at' => now()],
            ['id' => 3, 'role_id' => 1, 'user_id' => 3, 'profile_id' => 3, 'created_by' => 3, 'permissions' => json_encode($allBuyerPermissipns, true), 'created_at' => now()],
            ['id' => 4, 'role_id' => 1, 'user_id' => 4, 'profile_id' => 4, 'created_by' => 4, 'permissions' => json_encode($allSupplierPermissions, true), 'created_at' => now()],
            ['id' => 5, 'role_id' => 1, 'user_id' => 5, 'profile_id' => 5, 'created_by' => 5, 'permissions' => json_encode($allBuyerPermissipns, true), 'created_at' => now()],
            ['id' => 6, 'role_id' => 1, 'user_id' => 6, 'profile_id' => 6, 'created_by' => 6, 'permissions' => json_encode($allSupplierPermissions, true), 'created_at' => now()],

        ];


        $subscribtionsDetailsOne = DB::table('subscription_packages')->where('id', 1)->pluck('features')->first();
        $subscribtionsDetailsTwo = DB::table('subscription_packages')->where('id', 2)->pluck('features')->first();
        $subscribtionsDetailsThree = DB::table('subscription_packages')->where('id', 3)->pluck('features')->first();
        $subscribtionsDetailsFour = DB::table('subscription_packages')->where('id', 4)->pluck('features')->first();
        $subscribtionsDetailsFive = DB::table('subscription_packages')->where('id', 5)->pluck('features')->first();
        $subscribtions = [
            ['id' => 1, 'profile_id' => 1, 'package_id' => 1, 'user_id' => 1, 'sub_total' => 0.00, 'tax_amount' => 0.00, 'total' => 0.00, 'discount' => 0.00,  'status' => 'Paid', 'expire_date' => now()->addYear(), 'created_at' => now()],
            ['id' => 2, 'profile_id' => 2, 'package_id' => 2, 'user_id' => 2, 'sub_total' => 7500.00, 'tax_amount' => 1125.00, 'total' => 8625.00, 'discount' => 0.00,  'status' => 'Paid', 'expire_date' => now()->addYear(), 'created_at' => now()],
            ['id' => 3, 'profile_id' => 3, 'package_id' => 3, 'user_id' => 3, 'sub_total' => 0.00, 'tax_amount' => 0.00, 'total' => 0.00, 'discount' => 0.00,  'status' => 'Paid', 'expire_date' => now()->addYear(), 'created_at' => now()],
            ['id' => 4, 'profile_id' => 4, 'package_id' => 4, 'user_id' => 4, 'sub_total' => 7500.00, 'tax_amount' => 1125.00, 'total' => 8625.00, 'discount' => 0.00, 'status' => 'Paid', 'expire_date' => now()->addYear(), 'created_at' => now()],
            ['id' => 5, 'profile_id' => 5, 'package_id' => 5, 'user_id' => 5, 'sub_total' => 10000.00, 'tax_amount' => 1500.00, 'total' => 11500.00, 'discount' => 0.00,  'status' => 'Paid', 'expire_date' => now()->addYear(), 'created_at' => now()],
            ['id' => 6, 'profile_id' => 6, 'package_id' => 5, 'user_id' => 6, 'sub_total' => 0.00, 'tax_amount' => 0.00, 'total' => 0.00, 'discount' => 0.00,  'status' => 'Paid', 'expire_date' => now()->addYear(), 'created_at' => now()],

        ];
        foreach ($profiles as $profile) {

            $details = "";
            switch ($profile['id']) {
                case 1:
                    $details = $subscribtionsDetailsOne;
                    $createdby = 1;
                    break;
                case 2:
                    $details = $subscribtionsDetailsTwo;
                    $createdby = 2;

                    break;
                case 3:
                    $details = $subscribtionsDetailsThree;
                    $createdby = 3;

                    break;
                case 4:
                    $details = $subscribtionsDetailsFour;
                    $createdby = 4;

                    break;
                case 5:
                    $details = $subscribtionsDetailsFive;
                    $createdby = 5;

                    break;
                case 6:
                    $details = $subscribtionsDetailsFive;
                    $createdby = 6;
                    break;
            }

            DB::table('profiles')->insert([
                'id' => $profile['id'],
                'created_by' => $createdby,
                'name_ar' => $profile['name_ar'],
                'name_en' => $profile['name_en'],
                'swift' => $profile['swift'],
                'iban' => $profile['iban'],
                'type' => $profile['type'],
                'bank' => $profile['bank'],
                'vat_number' => $profile['vat_number'],
                'cr_number' => $profile['cr_number'],
                'cr_expire_data' => $profile['cr_expire_data'],
                'subs_id' => $profile['subs_id'],
                'subscription_details' => $details,
                 'created_at' => now(),
                'active' => $profile['active'],
            ]);
        }

        foreach ($users as $user) {
            DB::table('users')->insert([
                'id' => $user['id'],
                'email' => $user['email'],
                'password' => $user['password'],
                'created_at' => $user['created_at'],
                'is_verified' => $user['is_verified'],
                'is_super_admin' => $user['is_admin'],
                'full_name' => $user['full_name'],
                'identity_number' => $user['identity_number'],
                'identity_type' => $user['identity_type'],
                'password_changed' => $user['password_changed'],
                'mobile' => $user['mobile'],
                'profile_id' => $user['profile_id'],
            ]);
        }


        foreach ($subscribtions as $subscribtion) {
            DB::table('subscription_payments')->insert([
                'id' => $subscribtion['id'],
                'created_at' => $subscribtion['created_at'],
                'profile_id' => $subscribtion['profile_id'],
                'user_id' => $subscribtion['user_id'],
                'package_id' => $subscribtion['package_id'],
                'total' => $subscribtion['total'],
                'sub_total' => $subscribtion['sub_total'],
                'tax_amount' => $subscribtion['tax_amount'],
                'discount' => $subscribtion['discount'],
                'status' => $subscribtion['status'],
                'expire_date' => $subscribtion['expire_date'],
                'created_at' => $subscribtion['created_at'],
            ]);
        }

        foreach ($rolesUsersProfiles as $rolesUsersProfile) {
            $permssions = "";
            switch ($rolesUsersProfile['id']) {
                case 1:
                    $permssions = $allBuyerPermissipns;
                    break;
                case 2:
                    $permssions = $allSupplierPermissions;
                    break;
                case 3:
                    $permssions = $allBuyerPermissipns;
                    break;
                case 4:
                    $permssions = $allSupplierPermissions;
                    break;
                case 5:
                    $permssions = $allBuyerPermissipns;
                    break;
                case 6:
                    $permssions = $allSupplierPermissions;
                    break;
                }
                    DB::table('profile_role_user')->insert([
                        'id' => $rolesUsersProfile['id'],
                        'role_id' => $rolesUsersProfile['role_id'],
                        'user_id' => $rolesUsersProfile['user_id'],
                        'profile_id' => $rolesUsersProfile['profile_id'],
                        'created_by' => $rolesUsersProfile['created_by'],
                        'permissions' =>json_encode($permssions),

                    ]);
            }
        }
}
