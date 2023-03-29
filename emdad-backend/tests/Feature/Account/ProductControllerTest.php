<?php

namespace Tests\Feature\Account;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_product()
    {
        $response = $this->call('post', 'api/v1_0/products/create', [
            "categoryId" => '4',
            "name" => 'new',
            "price" => '10',
        ]);
        //dd($response->status());
        $response->assertStatus(200);
    }
    public function test_get_product_by_id()
    {
        $response = $this->call('get', 'api/v1_0/products/getById/1');
        $response->assertStatus(200);
    }
    public function test_show_all_products()
    {
        $response = $this->call('get', 'api/v1_0/products/getAll');
        $response->assertStatus(200);
    }
    public function test_update_products()
    {
        $response = $this->call('put', 'api/v1_0/products/update', ["id" => '1',]);
        $response->assertStatus(200);
    }
    public function test_delete_product()
    {
        $response = $this->call('delete', 'api/v1_0/products/delete/2');
        $response->assertStatus(301);
    }
    public function test_restore_products()
    {
        $response = $this->call('put', 'api/v1_0/products/restore/2');
        $response->assertStatus(200);
    }
}
