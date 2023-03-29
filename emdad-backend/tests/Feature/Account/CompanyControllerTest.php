<?php
namespace Tests\Feature\Account;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
class CompanyControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_account()
    {
        $response = $this->call('post', 'api/v1_0/accounts/create', [
            'name' => 'murtajada1122',
            'companyId' => 'sga2ad2as',
            'companyType' => 1,
            'companyVatId' => 'gsad22aasd',
            'contactName' => 'omfer22aff',
            'contactPhone' => '009661210000004',
            'contactEmail' => 'murtada.babdalgalil@nctr.sd',
            'subscriptionId' => 1,
        ]);
        //dd($response->status());
        $response->assertStatus(200);
    }
    public function test_get_all_company()
    {
        $response = $this->call('get', 'api/v1_0/accounts/getAll');
        //dd($response->status());
        $response->assertStatus(200);
    }
    public function test_get_all_validated()
    {
        $response = $this->call('get', 'api/v1_0/accounts/getAllUnValidated');
        //dd($response->status());
        $response->assertStatus(200);
    }
    public function test_validate_company()
    {
        $response = $this->call('put', 'api/v1_0/accounts/validate/1');
        $response->assertStatus(200);
    }
    public function test_get_comp_by_id()
    {
        $response = $this->call('get', 'api/v1_0/accounts/getById/1');
        $response->assertStatus(200);
    }
    public function test_update_company()
    {
        $response = $this->call('put', 'api/v1_0/accounts/update', [
            'id' => '2'
            // add another fied
        ]);
        $response->assertStatus(200);
    }
    public function test_delete_company()
    {
        $response = $this->call('delete', 'api/v1_0/accounts/delete/1');
        $response->assertStatus(301);
    }
    public function test_restore_company()
    {
        $response = $this->call('put', 'api/v1_0/accounts/restore/1');
        $response->assertStatus(200);
    }
    //warehouses
    public function test_create_warehouses()
    {
        $response = $this->call('post', 'api/v1_0/warehouses/create', [
            'warehouseName' => 'one',
            'warehouseType' => 'one',
            'location' => '12\222',
            'gateType' => 'one',
            'receiverName' => 'one',
            'receiverPhone' => '009660000000000'
        ]);
        //dd($response->status());
        $response->assertStatus(200);
    }
    public function test_get_all_warehouses()
    {
        $response = $this->call('get', 'api/v1_0/warehouses/getAll');
        //dd($response->status());
   $response->assertStatus(200);
    }
    public function test_get_by_id()
    {
        $response = $this->call('get', 'api/v1_0/warehouses/getById/2');
        //     //dd($response->status());
        $response->assertStatus(200);
    }
    public function test_validate_warehouses()
    {
        $response = $this->call('put', 'api/v1_0/warehouses/validate/1');
        $response->assertStatus(200);
    }
    public function test_get_comp_by_user_id()
    {
        $response = $this->call('get', 'api/v1_0/warehouses/getByUserId/1');
        $response->assertStatus(200);
    }
    public function test_get_by_com_id()
    {
        $response = $this->call('put', 'api/v1_0/warehouses/getByCompanyId/1');
        $response->assertStatus(200);
    }
    public function test_update_warehouses()
    {
        $response = $this->call('put', 'api/v1_0/warehouses/update', [
            'id' => '1',
            'warehouseName' => 'one',
            'warehouseType' => 'one',
            'location' => 'kh/om/s',
            'gateType' => 'one',
            'receiverName' => 'one',
        ]);
        $response->assertStatus(200);
    }
    public function test_restore_warehouses()
    {
        $response = $this->call('put', 'api/v1_0/warehouses/verfied', [
            'id' => 1,
            'userId' => 1,
            'companyId' => 1,
        ]);
        $response->assertStatus(200);
    }
    public function test_delete_warehouses()
    {
        $response = $this->call('delete', 'api/v1_0/warehouses/delete/1');
        $response->assertStatus(301);
    }
    public function test_restore_wharehouse()
    {
        $response = $this->call('put', 'api/v1_0/warehouses/restore/1');
        $response->assertStatus(200);
    }
    public function test_subscriptions_wharehouse()
    {

        $response = $this->call('put', 'api/v1_0/subscriptions/update', [
            'id' => '1',
            'updateOld' => 1,
            'subscriptionDetails' => 'okk',
            'subscriptionDetails.superAdmin' => 1,
            'subscriptionDetails.users' => 1,
            'subscriptionDetails.paymentMethods' => 'sdg',
            'subscriptionDetails.delivery' => 's',
            'subscriptionDetails.warehouses' => 1,
            'subscriptionDetails.addSuppliers' => 1,
            'subscriptionDetails.itemInEachRequisition' => 1,
            'subscriptionDetails.liveTracking' => 1,
            'subscriptionDetails.price' => 1,
        ]);
        $response->assertStatus(200);
    }
}
