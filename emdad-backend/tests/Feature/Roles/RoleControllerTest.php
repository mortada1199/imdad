<?php

namespace Tests\Feature\Roles;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoleControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function testsaveRole(){
        $response = $this->call('post','api/v1_0/permissions/save',[
            "name"=>"admin",
            "type"=>"1"
        ]);
        $response->assertStatus(200);
    }
    public function testgetallRoles(){
        $response = $this->call('get','api/v1_0/permissions/save',[
            "name"=>"admin",
            "type"=>"1"
        ]);
        $response->assertStatus(200);
    }
    public function testgetByRoleId(){
        $response = $this->call('get','api/v1_0/permissions/getByRoleId/1');
        $response->assertStatus(200);
    }
    public function testgetByType(){
        $response = $this->call('get','api/v1_0/permissions/getByType/1');
        $response->assertStatus(200);
    }
    public function updateRole(){
        $response = $this->call('put','api/v1_0/permissions/update/1');
        $response->assertStatus(200);
    }
    public function deleteRole(){
        $response = $this->call('delete','api/v1_0/permissions/delete/1');
        $response->assertStatus(301);
    }
    public function restoreByRoleId(){
        $response = $this->call('put','api/v1_0/permissions/restore/1');
        $response->assertStatus(200);
    }
}
