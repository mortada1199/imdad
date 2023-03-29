<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Accounts\SubscriptionPackages;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SubscriptionPackagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    $subscriptionsDetails = [
        ["id" => 1, "packageNameAr" => 'الأساسية', "packageNameEn"=>'Basic', "type" => 'Buyer',"price1" => "0", "price2" => "4500",
             "features" =>
             [
		["key"=>"owner","titleEn"=>"Business owner","titleAr"=>"المستخدم المالك/الرئيس التنفيذي","systemValue"=>1,"text_en"=>"1","text_ar"=>"1","descriptionEn"=>"The official account for the company, with full access to all pages and permissions.",
            "descriptionAr"=>"هو حساب الرئيس التنفيذي للشركة الذي يمتلك جميع صالحيات الوصول"],

        ["key"=>"user","titleEn"=>"User Management","titleAr"=>"إدارة المستخدمين","systemValue"=>3,"text_en"=>"3","text_ar"=>"3","descriptionEn"=>"The additional accounts with multiple roles and permissions assigned by the business owner, e.g.,Procurement Manager, Finance Officer…","descriptionAr"=>"الموظفين التابعين للشركة والمسؤولين عن أدوار وظيفية محددة بصلاحيات محددة يحددها مالك 
            الشركة؛ على سبيل المثال: مسؤول مشتريات، مسؤول مالي..."],

        ["key"=>"Cash","titleEn"=>"Cash Payment","titleAr"=>" الدفع بالكاش","systemValue"=>1,"text_en"=>"Cash","text_ar"=>"• الدفع المقدم","descriptionEn"=>"In the purchase order, when the payment method is cash, the buyer should pay before receiving the requisition. (Payment in advance).","descriptionAr"=>"الدفع المقدم: في امر شراء عند تحديد ألية الدفع المقدم، يُلزم الدفع قبل إستلام الطلب."],
   ["key"=>"Credit","titleEn"=>"Credit Agreement","titleAr"=>"اتفاق الائتمان","systemValue"=>0,"text_en"=>"Not Available","text_ar"=>"غير متاح","descriptionEn"=>"Credit: In the purchase order, when the payment method is credit and the receiving period is 
        specified, the payment will be after the agreed period expired and after receiving the requisition.","descriptionAr"=>"الدفع الآجل: في امر شراء عند تحديد ألية الدفع الآجلة وتحديد فترة معينة، يمكن إستلام الطلب 
        والدفع بعد انقضاء الفترة المحددة."],
        ["key"=>"Delivery","titleEn"=>"Delivery Scheduling ","titleAr"=>"جدولة التوريد","systemValue"=>1,"text_en"=>"One-Time Delivery","text_ar"=>"التوريد لمرة واحدة ","descriptionEn"=>"One-Time Delivery: a type of delivery in which the requisition is requested to be received one time on
a particular date.","descriptionAr"=>"التوريد لمرة واحدة: في امر شراء عند تحديد جدولة التوريد لمرة واحدة، يكون توريد الطلب على 
        .
        دفعة واحدة للطلب كاملا 
        التوريد المجزأ: في امر الشراء عند تحديد جدولة التوريد المجزأ، يتم تقسيم التوريدات لدفعات على 
        فترات مختلفة"],
        ["key"=>"Warehouse","titleEn"=>"Branch and Warehouse Management","titleAr"=>"إدارة الفروع والمستودعات","systemValue"=>2,"text_en"=>"2","text_ar"=>"2","descriptionEn"=>"The place to which the requisition is delivered.","descriptionAr"=>"في أمر شراء يتم تحديد الفرع او المستودع الذي سيتم توريد الطلب إليه. "],

        ["key"=>"Suppliers","titleEn"=>"Suppliers Management","titleAr"=>"إدارة الموردين","systemValue"=>30,"text_en"=>"30 ","text_ar"=>"30","descriptionEn"=>"The number of suppliers that can be added for direct dealing.","descriptionAr"=>"تمكن المنشأة من إضافة عدد من الموردين للتعامل المباشر، ويكون الحد الأعلى حسب باقة 
        الاشتراك."],

        ["key"=>"items","titleEn"=>"Number of items in a requestion","titleAr"=>"عدد المنتجات للطلب الواحد","systemValue"=>3,"text_en"=>"3","text_ar"=>"3","descriptionEn"=>"When creating a requisition, a certain number of items can be added according to the package. ","descriptionAr"=>"عند إنشاء الطلب يتم إضافة عدد معين من المنتجات لكل طلب ويكون الحد الأعلى حسب باقة 
        الاشتراك."],


        ["key"=>"Digital","titleEn"=>"Digital Statistics Report","titleAr"=>"التقارير الإحصائيات الرقمية","systemValue"=>1,"text_en"=>"Available","text_ar"=>"متوفر","descriptionEn"=>"Digital Statistics App: Offer a comprehensive overview to monitor your operations or your companies’ 
        operations in a single engine panel. Each engine offers a specific algorithm to extract your data and 
        analyse it, e.g., Procurement Analysis, Orders Analysis...","descriptionAr"=>"تستخدم هذه الإحصائيات خوارزميات تحلل جميع العمليات الخاصة بالمستخدم او المنشأة وتبثها في 
        محركات رقمية على شاشة واحدة؛ على سبيل المثال: محرك تحليل المشتريات، محرك تحليل 
        أوامر الشراء المعتمدة..."],

        ["key"=>"Points","titleEn"=>"Points of Digital Statistics Report ","titleAr"=>"عدد المنتجات للطلب الواحد","systemValue"=>3,"text_en"=>"3 Points","text_ar"=>"ثلاثه نقاط ","descriptionEn"=>"Points: Used to buy engines app beside the basic free engines.","descriptionAr"=>"تستخدم النقاط لشراء التقارير الإحصائية الرقمية، ويكون لكل مستخدم عدد معين من النقاط حسب باقة 
        الاشتراك."]

            ]


        ],


        ["id" => 2, "packageNameAr" => 'الفضية', "packageNameEn"=>'silver', "type" => 'Buyer',"price1" => "7500", "price2" => "7500",
             "features" =>
             [
                ["key"=>"owner","titleEn"=>"Business owner","titleAr"=>"المستخدم المالك/الرئيس التنفيذي","systemValue"=>1,"text_en"=>"1","text_ar"=>"1","descriptionEn"=>"The official account for the company, with full access to all pages and permissions.",
                "descriptionAr"=>"هو حساب الرئيس التنفيذي للشركة الذي يمتلك جميع صالحيات الوصول"],
    
            ["key"=>"user","titleEn"=>"User Management","titleAr"=>"إدارة المستخدمين","systemValue"=>15,"text_en"=>"15","text_ar"=>"15","descriptionEn"=>"The additional accounts with multiple roles and permissions assigned by the business owner, e.g.,Procurement Manager, Finance Officer…","descriptionAr"=>"الموظفين التابعين للشركة والمسؤولين عن أدوار وظيفية محددة بصالحيات محددة يحددها مالك 
    الشركة؛ على سبيل المثال: مسؤول مشتريات، مسؤول مالي..."],
    

         ["key"=>"Cash","titleEn"=>"Cash Payment","titleAr"=>" الدفع بالكاش","systemValue"=>1,"text_en"=>"Cash","text_ar"=>"• الدفع المقدم","descriptionEn"=>"In the purchase order, when the payment method is cash, the buyer should pay before receiving the requisition. (Payment in advance).","descriptionAr"=>"الدفع المقدم: في امر شراء عند تحديد ألية الدفع المقدم، يُلزم الدفع قبل إستلام الطلب."],
      
            ["key"=>"Credit","titleEn"=>"Credit Agreement","titleAr"=>"اتفاق الائتمان","systemValue"=>60,"text_en"=>"Credit – with period of 
            60 days","text_ar"=>"
            • الدفع الآجل - خلال 
            فترة لا تزيد عن 60
            يوما","descriptionEn"=>"Credit: In the purchase order, when the payment method is credit and the receiving period is 
        specified, the payment will be after the agreed period expired and after receiving the requisition.","descriptionAr"=>"الدفع الآجل: في امر شراء عند تحديد ألية الدفع الآجلة وتحديد فترة معينة، يمكن إستلام الطلب 
        والدفع بعد انقضاء الفترة المحددة."],
                
            ["key"=>"Delivery","titleEn"=>"Delivery Scheduling ","titleAr"=>"جدولة التوريد","systemValue"=>6,"text_en"=>"Standing Order – 6 Times","text_ar"=>"التوريد المجزأ – 6 فترات","descriptionEn"=>"The additional accounts with multiple roles and permissions assigned by the business owner, e.g.,Procurement Manager, Finance Officer…","descriptionAr"=>"التوريد لمرة واحدة: في امر شراء عند تحديد جدولة التوريد لمرة واحدة، يكون توريد الطلب على 
            .
            دفعة واحدة للطلب كاملا 
            التوريد المجزأ: في امر الشراء عند تحديد جدولة التوريد المجزأ، يتم تقسيم التوريدات لدفعات على 
            فترات مختلفة"],
            ["key"=>"Warehouse","titleEn"=>"Branch and Warehouse Management","titleAr"=>"إدارة الفروع والمستودعات","systemValue"=>15,"text_en"=>"15","text_ar"=>"15","descriptionEn"=>"The place to which the requisition is delivered.","descriptionAr"=>"في أمر شراء يتم تحديد الفرع او المستودع الذي سيتم توريد الطلب إليه. "],
            
            ["key"=>"Suppliers","titleEn"=>"Suppliers Management","titleAr"=>"إدارة الموردين","systemValue"=>50,"text_en"=>"50 ","text_ar"=>"50","descriptionEn"=>"The number of suppliers that can be added for direct dealing.","descriptionAr"=>"تمكن المنشأة من إضافة عدد من الموردين للتعامل المباشر، ويكون الحد الأعلى حسب باقة 
        الاشتراك."],

            ["key"=>"items","titleEn"=>"Number of items in a requestion","titleAr"=>"عدد المنتجات للطلب الواحد","systemValue"=>10,"text_en"=>"10","text_ar"=>"10","descriptionEn"=>"When creating a requisition, a certain number of items can be added according to the package. ","descriptionAr"=>"عند إنشاء الطلب يتم إضافة عدد معين من المنتجات لكل طلب ويكون الحد الأعلى حسب باقة 
            الاشتراك."],


            ["key"=>"Digital","titleEn"=>"Digital Statistics Report","titleAr"=>"تطبيقات الإحصائيات الرقمية","systemValue"=>1,"text_en"=>"Available","text_ar"=>"متوفر","descriptionEn"=>"Digital Statistics Report: Offer a comprehensive overview to monitor your operations or your companies’ 
            operations in a single engine panel. Each engine offers a specific algorithm to extract your data and 
            analyse it, e.g., Procurement Analysis, Orders Analysis...","descriptionAr"=>"تستخدم هذه الإحصائيات خوارزميات تحلل جميع العمليات الخاصة بالمستخدم او المنشأة وتبثها في 
        محركات رقمية على شاشة واحدة؛ على سبيل المثال: محرك تحليل المشتريات، محرك تحليل 
        أوامر الشراء المعتمدة..."],

            ["key"=>"Points","titleEn"=>"Points of Digital Statistics Report ","titleAr"=>"عدد المنتجات للطلب الواحد","systemValue"=>10,"text_en"=>"10 Points","text_ar"=>"نقطة 10","descriptionEn"=>"Points: Used to buy engines app beside the basic free engines.","descriptionAr"=>"تستخدم النقاط لشراء التقارير الإحصائية الرقمية، ويكون لكل مستخدم عدد معين من النقاط حسب باقة 
        الاشتراك."]

            
             ]



 ],
 ["id" => 3, "packageNameAr" => 'الذهبية', "packageNameEn"=>'Gold', "type" => 'Buyer',"price1" => "15000", "price2" => "15000",
             "features" =>
             [
                ["key"=>"owner","titleEn"=>"Business owner","titleAr"=>"المستخدم المالك/الرئيس التنفيذي","systemValue"=>1,"text_en"=>"1","text_ar"=>"1","descriptionEn"=>"The official account for the company, with full access to all pages and permissions.",
                "descriptionAr"=>"هو حساب الرئيس التنفيذي للشركة الذي يمتلك جميع صالحيات الوصول"],
    
            ["key"=>"user","titleEn"=>"User Management","titleAr"=>"إدارة المستخدمين","systemValue"=>30,"text_en"=>"30","text_ar"=>"30","descriptionEn"=>"The additional accounts with multiple roles and permissions assigned by the business owner, e.g.,Procurement Manager, Finance Officer…","descriptionAr"=>"الموظفين التابعين للشركة والمسؤولين عن أدوار وظيفية محددة بصالحيات محددة يحددها مالك 
    الشركة؛ على سبيل المثال: مسؤول مشتريات، مسؤول مالي..."],
    
        ["key"=>"Cash","titleEn"=>"Cash Payment","titleAr"=>" الدفع بالكاش","systemValue"=>1,"text_en"=>"Cash","text_ar"=>"• الدفع المقدم","descriptionEn"=>"In the purchase order, when the payment method is cash, the buyer should pay before receiving the requisition. (Payment in advance).","descriptionAr"=>"الدفع المقدم: في امر شراء عند تحديد ألية الدفع المقدم، يُلزم الدفع قبل إستلام الطلب."],
   
    ["key"=>"Credit","titleEn"=>"Credit Agreement","titleAr"=>"اتفاق الائتمان","systemValue"=>120,"text_en"=>"Credit – with period of 
            60 to 120 days","text_ar"=>" 
            • الدفع الآجل - خلال فترة 
            تتراوح ما بين 60 إلى 
            120 يوم","descriptionEn"=>"Credit: In the purchase order, when the payment method is credit and the receiving period is 
        specified, the payment will be after the agreed period expired and after receiving the requisition.","descriptionAr"=>"الدفع المقدم: في امر شراء عند تحديد ألية الدفع المقدم، يُلزم الدفع قبل إستالم الطلب. 
        الدفع الآجل: في امر شراء عند تحديد ألية الدفع الآجلة وتحديد فترة معينة، يمكن إستالم الطلب 
        والدفع بعد انقضاء الفترة المحددة"],

            ["key"=>"Delivery","titleEn"=>"Delivery Scheduling ","titleAr"=>"جدولة التوريد","systemValue"=>24,"text_en"=>"Standing Order – 24 Times","text_ar"=>"لتوريد المجزأ – 24 فترة","descriptionEn"=>"The additional accounts with multiple roles and permissions assigned by the business owner, e.g.,Procurement Manager, Finance Officer…","descriptionAr"=>"التوريد لمرة واحدة: في امر شراء عند تحديد جدولة التوريد لمرة واحدة، يكون توريد الطلب على 
            .
            دفعة واحدة للطلب كاملا 
            التوريد المجزأ: في امر الشراء عند تحديد جدولة التوريد المجزأ، يتم تقسيم التوريدات لدفعات على 
            فترات مختلفة"],
            ["key"=>"Warehouse","titleEn"=>"Branch and Warehouse Management","titleAr"=>"إدارة الفروع والمستودعات","systemValue"=>30,"text_en"=>"30","text_ar"=>"30","descriptionEn"=>"The place to which the requisition is delivered.","descriptionAr"=>"في أمر شراء يتم تحديد الفرع او المستودع الذي سيتم توريد الطلب إليه. "],
           
            ["key"=>"Suppliers","titleEn"=>"Suppliers Management","titleAr"=>"إدارة الموردين","systemValue"=>80,"text_en"=>"80 ","text_ar"=>"80","descriptionEn"=>"The number of suppliers that can be added for direct dealing.","descriptionAr"=>"تمكن المنشأة من إضافة عدد من الموردين للتعامل المباشر، ويكون الحد الأعلى حسب باقة 
        الاشتراك."],

            ["key"=>"items","titleEn"=>"Number of items in a requisition","titleAr"=>"عدد المنتجات للطلب الواحد","systemValue"=>20,"text_en"=>"20","text_ar"=>"20","descriptionEn"=>"When creating a requisition, a certain number of items can be added according to the package. ","descriptionAr"=>"عند إنشاء الطلب يتم إضافة عدد معين من المنتجات لكل طلب ويكون الحد الأعلى حسب باقة 
            الاشتراك."],


            ["key"=>"Digital","titleEn"=>"Digital Statistics Report","titleAr"=>"تطبيقات الإحصائيات الرقمية","systemValue"=>1,"text_en"=>"Available","text_ar"=>" متوفر","descriptionEn"=>"Digital Statistics Report: Offer a comprehensive overview to monitor your operations or your companies’ 
            operations in a single engine panel. Each engine offers a specific algorithm to extract your data and 
            analyse it, e.g., Procurement Analysis, Orders Analysis...","descriptionAr"=>"تستخدم هذه الإحصائيات خوارزميات تحلل جميع العمليات الخاصة بالمستخدم او المنشأة وتبثها في 
        محركات رقمية على شاشة واحدة؛ على سبيل المثال: محرك تحليل المشتريات، محرك تحليل 
        أوامر الشراء المعتمدة..."],

            ["key"=>"Points","titleEn"=>"Points of Digital Statistics Report ","titleAr"=>"عدد المنتجات للطلب الواحد","systemValue"=>15,"text_en"=>"15 Points","text_ar"=>"نقطة 10","descriptionEn"=>"Points: Used to buy engines app beside the basic free engines.","descriptionAr"=>"تستخدم النقاط لشراء التقارير الإحصائية الرقمية، ويكون لكل مستخدم عدد معين من النقاط حسب باقة 
        الاشتراك."]
            
            
            
             ]



 ],


["id" => 4, "packageNameAr" => 'الأساسية', "packageNameEn"=>'Basic', "type" => 'Supplier',"price1" => "0", "price2" => "4500",
        "features" =>[
            ["key"=>"owner","titleEn"=>"Business owner","titleAr"=>"المستخدم المالك/الرئيس التنفيذي","systemValue"=>1,"text_en"=>"1","text_ar"=>"1","descriptionEn"=>"The official account for the company, with full access to all pages and permissions.",
            "descriptionAr"=>"هو حساب الرئيس التنفيذي للشركة الذي يمتلك جميع صالحيات الوصول"],
            ["key"=>"user","titleEn"=>"User Management","titleAr"=>"إدارة المستخدمين","systemValue"=>15,"text_en"=>"15","text_ar"=>"15","descriptionEn"=>"The additional accounts with multiple roles and permissions assigned by the business owner, e.g.,Procurement Manager, Finance Officer…","descriptionAr"=>"الموظفين التابعين للشركة والمسؤولين عن أدوار وظيفية محددة بصالحيات محددة يحددها مالك 
الشركة؛ على سبيل المثال: مسؤول مشتريات، مسؤول مالي..."],
            ["key"=>"Warehouse","titleEn"=>"Branch and Warehouse Management","titleAr"=>"إدارة الفروع والمستودعات","systemValue"=>10,"text_en"=>"10","text_ar"=>"10","descriptionEn"=>"The place to which the requisition is delivered.","descriptionAr"=>"في أمر شراء يتم تحديد الفرع او المستودع الذي سيتم توريد الطلب إليه. "],

            ["key"=>"Customers","titleEn"=>"Customers Management","titleAr"=>"إدارة العملاء","systemValue"=>100,"text_en"=>"100","text_ar"=>"100","descriptionEn"=>"The ability to create new roles, for the users, in addition to the existing roles","descriptionAr"=>"مكانية إنشاء أدوار وظيفية جديد ة عند إضافة المستخدمين."],

            ["key"=>"IOS","titleEn"=>"Digital Statistics Report","titleAr"=>"تطبيقات الإحصائيات الرقمية","systemValue"=>0,"text_en"=>"Available IOS/Android","text_ar"=>"متاح
            IOS/Android","descriptionEn"=>"Application enables the drivers to deliver the order from the warehouse to the buyer.","descriptionAr"=>"يستخدم التطبيق لتمكين السائق من توصيل وتسليم الطلب من المستودع إلى المشتري."],

            ["key"=>"Digital","titleEn"=>"Digital Statistics Report","titleAr"=>"تطبيقات المحركات الرقمية","systemValue"=>1,"text_en"=>"Available","text_ar"=>"متاح","descriptionEn"=>"Digital Statistics Report: Offer a comprehensive overview to monitor your operations or your companies’ 
            operations in a single engine panel. Each engine offers a specific algorithm to extract your data and 
            analyse it, e.g., Procurement Analysis, Orders Analysis...","descriptionAr"=>"تستخدم هذه الإحصائيات خوارزميات تحلل جميع العمليات الخاصة بالمستخدم او المنشأة وتبثها في 
        محركات رقمية على شاشة واحدة؛ على سبيل المثال: محرك تحليل المشتريات، محرك تحليل 
        أوامر الشراء المعتمدة..."],
    
            ["key"=>"Points","titleEn"=>"Points of Digital Statistics Report ","titleAr"=>"عدد المنتجات للطلب الواحد","systemValue"=>3,"text_en"=>"3 Points","text_ar"=>"ثلاث نقاط","descriptionEn"=>"Points: Used to buy engines app beside the basic free engines.","descriptionAr"=>"تستخدم النقاط لشراء التقارير الإحصائية الرقمية، ويكون لكل مستخدم عدد معين من النقاط حسب باقة 
        الاشتراك."]
 ]
 

],

["id" => 5, "packageNameAr" => 'الذهبية', "packageNameEn"=>'Gold', "type" => 'Supplier',"price1" => "10000", "price2" => "10000",
        "features" =>[
            ["key"=>"owner","titleEn"=>"Business owner","titleAr"=>"المستخدم المالك/الرئيس التنفيذي","systemValue"=>1,"text_en"=>"1","text_ar"=>"1","descriptionEn"=>"The official account for the company, with full access to all pages and permissions.",
            "descriptionAr"=>"هو حساب الرئيس التنفيذي للشركة الذي يمتلك جميع صالحيات الوصول"],
            ["key"=>"user","titleEn"=>"User Management","titleAr"=>"إدارة المستخدمين","systemValue"=>50,"text_en"=>"50","text_ar"=>"50","descriptionEn"=>"The additional accounts with multiple roles and permissions assigned by the business owner, e.g.,Procurement Manager, Finance Officer…","descriptionAr"=>"الموظفين التابعين للشركة والمسؤولين عن أدوار وظيفية محددة بصالحيات محددة يحددها مالك 
الشركة؛ على سبيل المثال: مسؤول مشتريات، مسؤول مالي..."],
            ["key"=>"Warehouse","titleEn"=>"Branch and Warehouse Management","titleAr"=>"إدارة الفروع والمستودعات","systemValue"=>50,"text_en"=>"50","text_ar"=>"50","descriptionEn"=>"The place to which the requisition is delivered.","descriptionAr"=>"في أمر شراء يتم تحديد الفرع او المستودع الذي سيتم توريد الطلب إليه. "],
            
            ["key"=>"Customers","titleEn"=>"Customers Management","titleAr"=>"إدارة العملاء","systemValue"=>300,"text_en"=>"300","text_ar"=>"300","descriptionEn"=>"The ability to create new roles, for the users, in addition to the existing roles","descriptionAr"=>"مكانية إنشاء أدوار وظيفية جديد ة عند إضافة المستخدمين."],

              ["key"=>"IOS","titleEn"=>"Digital Statistics Report","titleAr"=>"تطبيقات الإحصائيات الرقمية","systemValue"=>1,"text_en"=>"Available IOS/Android","text_ar"=>"متاح
            IOS/Android","descriptionEn"=>"Application enables the drivers to deliver the order from the warehouse to the buyer.","descriptionAr"=>"يستخدم التطبيق لتمكين السائق من توصيل وتسليم الطلب من المستودع إلى المشتري."],

          
            ["key"=>"Digital","titleEn"=>"Digital Statistics Points","titleAr"=>"تطبيقات الإحصائيات الرقمية","systemValue"=>1,"text_en"=>"Available","text_ar"=>" متوفر","descriptionEn"=>"Digital Statistics Report: Offer a comprehensive overview to monitor your operations or your companies’ 
            operations in a single engine panel. Each engine offers a specific algorithm to extract your data and 
            analyse it, e.g., Procurement Analysis, Orders Analysis...","descriptionAr"=>"تستخدم هذه الإحصائيات خوارزميات تحلل جميع العمليات الخاصة بالمستخدم او المنشأة وتبثها في 
        محركات رقمية على شاشة واحدة؛ على سبيل المثال: محرك تحليل المشتريات، محرك تحليل 
        أوامر الشراء المعتمدة..."],

            ["key"=>"Points","titleEn"=>"Points of Digital Statistics Report ","titleAr"=>"عدد المنتجات للطلب الواحد","systemValue"=>15,"text_en"=>"15 Points","text_ar"=>"نقطة 10","descriptionEn"=>"Points: Used to buy engines app beside the basic free engines.","descriptionAr"=>"تستخدم النقاط لشراء التقارير الإحصائية الرقمية، ويكون لكل مستخدم عدد معين من النقاط حسب باقة 
        الاشتراك."]
 ]
 

],



];



        foreach ($subscriptionsDetails as $subscriptionsDetail) {
            DB::table('subscription_packages')->insert([
                "id" => $subscriptionsDetail["id"],
                "package_name_ar" => $subscriptionsDetail["packageNameAr"],
                "package_name_en" => $subscriptionsDetail["packageNameEn"],
                "type" => $subscriptionsDetail["type"],
                "price_1" => $subscriptionsDetail["price1"],
                "price_2" => $subscriptionsDetail["price2"],
                "features" => json_encode($subscriptionsDetail['features'], true),
                "created_at" => Carbon::now(),
            ]);
        }
    }
}
