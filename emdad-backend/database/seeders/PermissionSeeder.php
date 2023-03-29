<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $permissions = [
            //Buyer user management
            ["name" => "buyer_User_Management_Entering_to_users_smart_link", "label" => "BMU21", "category" => "BMU", "description" => ""],
            ["name" => "buyer_User_Management_activate", "label" => "BMU5", "category" => "BMU", "description" => ""],
            ["name" => "buyer_User_Management_deActivate", "label" => "BMU10", "category" => "BMU", "description" => ""],

            ["name" => "buyer_User_Management_editing", "label" => "BMU2", "category" => "BMU", "description" => ""],
            ["name" => "buyer_User_Management_Adding", "label" => "BMU1", "category" => "BMU", "description" => ""],
            ["name" => "buyer_User_Management_Viewing", "label" => "BMU4", "category" => "BMU", "description" => ""],
            // Buyer Category 
            ["name" => "buyer_Category_Management_smart_link", "label" => "BMT21", "category" => "BMT", "description" => ""],
            ["name" => "buyer_Category_Management_active", "label" => "BMT5", "category" => "BMT", "description" => ""],
            ["name" => "buyer_Category_Management_deactive", "label" => "BMT10", "category" => "BMT", "description" => ""],

            ["name" => "buyer_Category_Management_adding", "label" => "BMT1", "category" => "BMT", "description" => ""],
            ["name" => "buyer_Category_Management_Requesting", "label" => "BMT12", "category" => "BMT", "description" => ""],
            ["name" => "buyer_Category_Management_view", "label" => "BMT4", "category" => "BMT", "description" => ""],
            //Buyer Product
            ["name" => "buyer_Product_Management_smart_link", "label" => "BMP21", "category" => "BMP", "description" => ""],
            ["name" => "buyer_Product_Management_adding", "label" => "BMP1", "category" => "BMP", "description" => ""],
            ["name" => "buyer_Product_Management_view", "label" => "BMP4", "category" => "BMP", "description" => ""],
            //supplier  user management
            ["name" => "supplier_user_smart_link", "label" => "SMU21", "category" => "SMU", "description" => ""],
            ["name" => "supplier_user_activate", "label" => "SMU5", "category" => "SMU", "description" => ""],
            ["name" => "supplier_user_deActive", "label" => "SMU10", "category" => "SMU", "description" => ""],

            ["name" => "supplier_user_edit", "label" => "SMU2", "category" => "SMU", "description" => ""],
            ["name" => "supplier_user_add", "label" => "SMU1", "category" => "SMU", "description" => ""],
            ["name" => "supplier_user_view", "label" => "SMU4", "category" => "SMU", "description" => ""],
            // supplier Category
            ["name" => "supplier_Category_Management_smart_link", "label" => "SMT21", "category" => "SMT", "description" => ""],
            ["name" => "supplier_Category_Management_active", "label" => "SMT5", "category" => "SMT", "description" => ""],
            ["name" => "supplier_Category_Management_deActive", "label" => "SMT10", "category" => "SMT", "description" => ""],

            ["name" => "supplier_Category_Management_adding", "label" => "SMT1", "category" => "SMT", "description" => ""],
            ["name" => "supplier_Category_Management_Requesting", "label" => "SMT12", "category" => "SMT", "description" => ""],
            ["name" => "supplier_Category_Management_view", "label" => "SMT4", "category" => "SMT", "description" => ""],
            //Supplier Product
            ["name" => "supplier_Product_Management_smart_link", "label" => "SMP21", "category" => "SMP", "description" => ""],
            ["name" => "supplier_Product_Management_adding", "label" => "SMP1", "category" => "SMP", "description" => ""],
            ["name" => "supplier_Product_Management_view", "label" => "SMP4", "category" => "SMP", "description" => ""],
            //supplier driver management 
            ["name" => "supplier_driver_edit", "label" => "SMFLD2", "category" => "SMFLD", "description" => ""],
            ["name" => "supplier_driver_add", "label" => "SMFLD1", "category" => "SMFLD", "description" => ""],
            ["name" => "supplier_driver_view", "label" => "SMFLD4", "category" => "SMFLD", "description" => ""],
            ["name" => "supplier_driver_delete", "label" => "SMFLD3", "category" => "SMFLD", "description" => ""],
            //supplier truck management 
            ["name" => "supplier_truck_edit", "label" => "SMFLT2", "category" => "SMFLT", "description" => ""],
            ["name" => "supplier_truck_add", "label" => "SMFLT1", "category" => "SMFLT", "description" => ""],
            ["name" => "supplier_truck_view", "label" => "SMFLT4", "category" => "SMFLT", "description" => ""],
            ["name" => "supplier_truck_delete", "label" => "SMFLT3", "category" => "SMFLT", "description" => ""],
            //supplier profile management 
            ["name" => "supplier_add_profiles", "label" => "SMC1", "category" => "SMC", "description" => ""],
            ["name" => "supplier_view_profiles", "label" => "SMC4", "category" => "SMC", "description" => ""],
            //Buyer profile management 
            ["name" => "buyer_add_profiles", "label" => "BMC1", "category" => "BMC", "description" => ""],
            ["name" => "buyer_view_profiles", "label" => "BMC4", "category" => "BMC", "description" => ""],
            //buyer management profile subscriptions
            ["name" => "buyer_Company_subscription_freeze_for_a_period", "label" => "BMCS15", "category" => "BMCS", "description" => ""],
            ["name" => "buyer_Company_upgarde", "label" => "BMCS19", "category" => "BMCS", "description" => ""],
            ["name" => "buyer_Company_reNew", "label" => "BMCS20", "category" => "BMCS", "description" => ""],
            ["name" => "buyer_Company_Viewing_subscription", "label" => "BMCS4", "category" => "BMCS", "description" => ""],
            //supplier management profile subscriptions
            ["name" => "supplier_Company_subscription_freeze_for_a_period", "label" => "SMC15", "category" => "SMCS", "description" => ""],
            ["name" => "supplier_Company_upgarde", "label" => "SMCS19", "category" => "SMCS", "description" => ""],
            ["name" => "supplier_Company_reNew", "label" => "SMCS20", "category" => "SMCS", "description" => ""],
            ["name" => "supplier_Company_Viewing_subscription", "label" => "SMCS4", "category" => "SMCS", "description" => ""],
            //buyer warehouse
            ["name" => "buyer_Management_warehouses_smart_link", "label" => "BMW21", "category" => "BMW", "description" => ""],
            ["name" => "buyer_Management_warehouses_add", "label" => "BMW1", "category" => "BMW", "description" => ""],
            ["name" => "buyer_Management_warehouses_view", "label" => "BMW4", "category" => "BMW", "description" => ""],
            ["name" => "buyer_Management_warehouses_edit", "label" => "BMW2", "category" => "BMW", "description" => ""],
            //supplier warehouse
            ["name" => "Supplier_Management_warehouses_smart_link", "label" => "SMW21", "category" => "SMW", "description" => ""],
            ["name" => "Supplier_Management_warehouses_add", "label" => "SMW1", "category" => "SMW", "description" => ""],
            ["name" => "Supplier_Management_warehouses_edit", "label" => "SMW2", "category" => "SMW", "description" => ""],
            ["name" => "Supplier_Management_warehouses_view", "label" => "SMW4", "category" => "SMW", "description" => ""],




            // ["name" => "supplier_Fleet_active", "label" => "SMFL5", "category" => "SMFL", "description" => ""],
            // ["name" => "supplier_Fleet_unactive", "label" => "SMFL10", "category" => "SMFL", "description" => ""],
            // ["name" => "supplier_Fleet_restore", "label" => "SMFL47", "category" => "SMFL", "description" => ""],
            // ["name" => "buyer_rfq_publish", "label" => "BR1", "category" => "BR", "description" => ""],
            // ["name" => "buyer_rfq_view_create", "label" => "BR2", "category" => "BR", "description" => ""],
            // ["name" => "buyer_rfq_view", "label" => "BR3", "category" => "BR", "description" => ""],
            // ["name" => "buyer_quotes_negotiate_accept", "label" => "BQ1", "category" => "BQ", "description" => ""],
            // ["name" => "buyer_quotes_view_negotiate", "label" => "BQ2", "category" => "BQ", "description" => ""],
            // ["name" => "buyer_quotes_view_rejected", "label" => "BQ3", "category" => "BQ", "description" => ""],
            // ["name" => "buyer_po_publish", "label" => "BP1", "category" => "BP", "description" => ""],
            // ["name" => "buyer_po_create", "label" => "BP2", "category" => "BP", "description" => ""],
            // ["name" => "buyer_po_view", "label" => "BP3", "category" => "BP", "description" => ""],
            // ["name" => "buyer_invoice_pay", "label" => "BI1", "category" => "BI", "description" => ""],
            // ["name" => "buyer_invoice_view", "label" => "BI2", "category" => "BI", "description" => ""],
            // ["name" => "buyer_delivery_recieve", "label" => "BD1", "category" => "BD", "description" => ""],
            // ["name" => "buyer_delivery_view", "label" => "BD2", "category" => "BD", "description" => ""],
            // ["name" => "buyer_delivery_return", "label" => "BD3", "category" => "BD", "description" => ""],
            // ["name" => "supplier_rfq_reject", "label" => "SRFQ3", "category" => "SRFQ", "description" => ""],
            // ["name" => "supplier_rfq_accept", "label" => "SRFQ2", "category" => "SRFQ", "description" => ""],
            // ["name" => "supplier_rfq_view", "label" => "SRFQ1", "category" => "SRFQ", "description" => ""],
            // ["name" => "supplier_quotes_send", "label" => "SQ6", "category" => "SQ", "description" => ""],
            // ["name" => "supplier_quotes_cancel", "label" => "SQ5", "category" => "SQ", "description" => ""],
            // ["name" => "supplier_quotes_renew", "label" => "SQ4", "category" => "SQ", "description" => ""],
            // ["name" => "supplier_quotes_reject", "label" => "SQ3", "category" => "SQ", "description" => ""],
            // ["name" => "supplier_quotes_edit", "label" => "SQ2", "category" => "SQ", "description" => ""],
            // ["name" => "supplier_quotes_create", "label" => "SQ1", "category" => "SQ", "description" => ""],
            // ["name" => "supplier_orders_cancel", "label" => "SPO2", "category" => "SPO", "description" => ""],
            // ["name" => "supplier_orders_view", "label" => "SPO1", "category" => "SPO", "description" => ""],
            // ["name" => "supplier_tax_invoices_view", "label" => "SCL1", "category" => "SCL", "description" => ""],
            // ["name" => "supplier_credit_Agreements_edit", "label" => "SCR45", "category" => "SCR", "description" => ""],
            // ["name" => "supplier_credit_Agreements_accept", "label" => "SCR4", "category" => "SCR", "description" => ""],
            // ["name" => "supplier_credit_Agreements_invite", "label" => "SCR3", "category" => "SCR", "description" => ""],
            // ["name" => "supplier_credit_Agreements_reject", "label" => "SCR2", "category" => "SCR", "description" => ""],
            // ["name" => "supplier_credit_Agreements_view", "label" => "SCR1", "category" => "SCR1", "description" => ""],
            // ["name" => "supplier_pending_deliveries_return", "label" => "SDD7", "category" => "SDD", "description" => ""],
            // ["name" => "supplier_pending_deliveries_accept", "label" => "SDD6", "category" => "SDD", "description" => ""],
            // ["name" => "supplier_pending_deliveries_assign_driver_to_truck", "label" => "SDD5", "category" => "SDD", "description" => ""],
            // ["name" => "supplier_pending_deliveries_requst", "label" => "SDD4", "category" => "SDD", "description" => ""],
            // ["name" => "supplier_pending_deliveries_edit", "label" => "SDD3", "category" => "SDD", "description" => ""],
            // ["name" => "supplier_pending_deliveries_accept", "label" => "SDD2", "category" => "SDD", "description" => ""],
            // ["name" => "supplier_pending_deliveries_view", "label" => "SDD1", "category" => "SDD", "description" => ""],
            // ["name" => "supplier_tracking_accept", "label" => "SAP6", "category" => "SAP", "description" => ""],
            // ["name" => "supplier_tracking_edit", "label" => "SAP5", "category" => "SAP", "description" => ""],
            // ["name" => "supplier_tracking_delivery", "label" => "SAP4", "category" => "SAP", "description" => ""],
            // ["name" => "supplier_tracking_reject", "label" => "SAP3", "category" => "SAP", "description" => ""],
            // ["name" => "supplier_tracking_return", "label" => "SAP2", "category" => "SAP", "description" => ""],
            // ["name" => "supplier_tracking_proceding_full_chain_delivery", "label" => "SAP1", "category" => "SAP", "description" => ""],
            // ["name" => "supplier_customer_freeze_delayed_payment", "label" => "SMCS6", "category" => "SMCS", "description" => ""],
            // ["name" => "supplier_customer_partnership_freeze", "label" => "SMCS5", "category" => "SMCS", "description" => ""],
            // ["name" => "supplier_customer_accept", "label" => "SMCS4", "category" => "SMCS", "description" => ""],
            // ["name" => "supplier_customer_reject", "label" => "SMCS3", "category" => "SMCS", "description" => ""],
            // ["name" => "supplier_customer_add_request_join", "label" => "SMCS2", "category" => "SMCS", "description" => ""],
            // ["name" => "supplier_customer_view", "label" => "SMCS1", "category" => "SMCS", "description" => ""],
            // ["name" => "supplier_user_inter", "label" => "SMU7", "category" => "SMU", "description" => ""],
            // ["name" => "supplier_user_accept", "label" => "SMU8", "category" => "SMU", "description" => ""],
            // ["name" => "supplier_user_restore", "label" => "SMU47", "category" => "SMU", "description" => ""],
            // ["name" => "supplier_user_reject", "label" => "SMU9", "category" => "SMU", "description" => ""],
            // ["name" => "supplier_user_delete", "label" => "SMU3", "category" => "SMU", "description" => ""],
            // ["name" => "supplier_communication_company_messages", "label" => "SML2", "category" => "SML", "description" => ""],
            // ["name" => "supplier_communication_user_messages", "label" => "SML1", "category" => "SML", "description" => ""],
            // ["name" => "supplier_account_subscription_freeze", "label" => "SMC3", "category" => "SMC", "description" => ""],
            // ["name" => "supplier_account_subscription_view_sub_upgrade", "label" => "SMC2", "category" => "SMC", "description" => ""],
            // ["name" => "supplier_account_subscription_view_company", "label" => "SMC1", "category" => "SMC", "description" => ""],
            // ["name" => "supplier_category_prdouct_managment_adding", "label" => "SMCT1", "category" => "SMCT", "description" => ""],
            // ["name" => "supplier_category_prdouct_managment_requesting", "label" => "SMCT12", "category" => "SMCT", "description" => ""],

            // ["name" => "supplier_category_prdouct_managment_view", "label" => "SMCT4", "category" => "SMCT", "description" => ""],
            // ["name" => "supplier_notification_all_company", "label" => "SMUP2", "category" => "SMUP", "description" => ""],
            // ["name" => "supplier_notification_user", "label" => "SMUP1", "category" => "SMUP", "description" => ""],
            // ["name" => "supplier_alrts_view", "label" => "SMAL1", "category" => "SMAL", "description" => ""],
            // ["name" => "supplier_business_mail_create_action_send", "label" => "SMMB2", "category" => "SMMB", "description" => ""],
            // ["name" => "supplier_business_mail_view", "label" => "SMMB1", "category" => "SMMB", "description" => ""],


            // ["name" => "supplier_digital_apps_all_reports", "label" => "SMAP2", "category" => "SMAP", "description" => ""],
            // ["name" => "supplier_digital_user_reports", "label" => "SMAP1", "category" => "SMAP", "description" => ""],
            // ["name" => "buyer_supplier_Partenership_freeze", "label" => "BMCD7", "category" => "BMCD", "description" => ""],
            // ["name" => "buyer_supplier_Accepting", "label" => "BMCD8", "category" => "BMCD", "description" => ""],
            // ["name" => "buyer_supplier_Rejecting", "label" => "BMCD9", "category" => "BMCD", "description" => ""],

            // ["name" => "buyer_supplier_Adding", "label" => "BMCD1", "category" => "BMCD", "description" => ""],
            // ["name" => "buyer_supplier_request_to_join", "label" => "BMCD3", "category" => "BMCD", "description" => ""],
            // ["name" => "buyer_Adding_More_Company_Adding", "label" => "BMCD1", "category" => "BMCD", "description" => ""],

            // ["name" => "buyer_supplier_Viewing_suppliers_profile", "label" => "BMCD4", "category" => "BMCD", "description" => ""],




            // ["name" => "buyer_User_Management_Entering_to_users_account", "label" => "BMU11", "category" => "BMU", "description" => ""],
            // ["name" => "buyer_User_Management_deleting", "label" => "BMU3", "category" => "BMU", "description" => ""],
            // ["name" => "buyer_User_Management_restore", "label" => "BMU47", "category" => "BMU", "description" => ""],

            // ["name" => "buyer_User_Live_Communication_All_company_messeges", "label" => "BML2", "category" => "BML", "description" => ""],
            // ["name" => "buyer_User_Live_Communication_User's_own_messages", "label" => "BML1", "category" => "BML", "description" => ""],






            // ["name" => "buyer_Credit_Agreements_Requesting", "label" => "BMCT12", "category" => "BMCT", "description" => ""],
            // ["name" => "buyer_Credit_Agreements_rejecting", "label" => "BMCT9", "category" => "BMCT", "description" => ""],
            // ["name" => "buyer_Credit_Agreements_accepting", "label" => "BMCT8", "category" => "BMCT", "description" => ""],
            // ["name" => "buyer_Credit_Agreements_Viewing", "label" => "BMCT4", "category" => "BMCT", "description" => ""],

            // ["name" => "buyer_Category_and_Products_Management_Viewing", "label" => "BMCT4", "category" => "BMCT", "description" => ""],
            // ["name" => "buyer_Notifications_All_company_notifications", "label" => "BMNM2", "category" => "BMNM", "description" => ""],
            // ["name" => "buyer_Notifications_User's_own_notifications", "label" => "BMNM1", "category" => "BMNM", "description" => ""],
            // ["name" => "buyer_Alrts_Box_Viewing", "label" => "BMCA2", "category" => "BMCA", "description" => ""],
            // ["name" => "buyer_Bussiness_Mail_Creating", "label" => "BMMB5", "category" => "BMMB", "description" => ""],
            // ["name" => "buyer_Bussiness_Mail_Creating", "label" => "BMMB4", "category" => "BMMB", "description" => ""],
            // ["name" => "buyer_Bussiness_Mail_approving", "label" => "BMMB3", "category" => "BMMB", "description" => ""],
            // ["name" => "buyer_Bussiness_Mail_closing_agreements", "label" => "BMMB2", "category" => "BMMB", "description" => ""],
            // ["name" => "buyer_Bussiness_Mail_Viewing", "label" => "BMMB1", "category" => "BMMB", "description" => ""],
            // ["name" => "buyer_Digital_Engines_Apps_All_company_reports", "label" => "BMDE2", "category" => "BMDE", "description" => ""],
            // ["name" => "buyer_Digital_Engines_Apps_User's_own_reports", "label" => "BMDE1", "category" => "BMDE", "description" => ""],



            // ["name" => "buyer_Management_warehouses_delete", "label" => "BMW3", "category" => "BMW", "description" => ""],
            // ["name" => "buyer_Management_warehouses_reject", "label" => "BMW9", "category" => "BMW", "description" => ""],
            // ["name" => "buyer_Management_warehouses_accept", "label" => "BMW8", "category" => "BMW", "description" => ""],
            // ["name" => "buyer_Management_warehouses_restore", "label" => "BMW47", "category" => "BMW", "description" => ""],



            // ["name" => "Supplier_Management_warehouses_restore", "label" => "SMW47", "category" => "SMW", "description" => ""],

            // ["name" => "Supplier_Management_warehouses_delete", "label" => "SMW3", "category" => "SMW", "description" => ""],
            // ["name" => "Supplier_Management_warehouses_reject", "label" => "SMW9", "category" => "SMW", "description" => ""],
            // ["name" => "Supplier_Management_warehouses_accept", "label" => "SMW8", "category" => "SMW", "description" => ""],

        ];

        foreach ($permissions as $permission) {
            # code...

            DB::table('permissions')->insert([
                "name" => $permission['name'],
                "label" => $permission['label'],
                "description" => $permission['description'],
                'category' => $permission['category'],
                "created_at" => now()
            ]);
        }
    }
}
