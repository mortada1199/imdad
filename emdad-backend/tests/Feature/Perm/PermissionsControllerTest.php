<?php

namespace Tests\Feature\Perm;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PermissionsControllerTest extends TestCase
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
    public function testcreatePermisssion(){
        $response = $this->call('post','api/v1_0/permissions/save',[
            'role'=>'admin',
            'privileges'=>'all',
            'privileges.*'=>['required','integer','exists:permissions,id']
        ]);
        $response->assertStatus(200);
    }
    public function testgetallPermissions(){
    $response = $this->call('post','api/v1_0/permissions/getAll',[
        'id'=>'admin',
    ]);
    $response->assertStatus(200);
    }

    public function testgetByIdPermissions(){
        $response = $this->call('put','api/v1_0/permissions/update/1');
        $response->assertStatus(200);
    }
    public function testupdatePermissions(){
        $response = $this->call('put','api/v1_0/permissions/updatePermission',[
            'id' => '1',
            'privileges'=>'[admin,user]',
            'privileges.*'=>'4'
        ]);
        $response->assertStatus(200);
    }
    public function testrestoreByRoleIdPermissions(){
        $response = $this->call('put','api/v1_0/permissions/restoreByRoleId/1');
        $response->assertStatus(200);
    }

}
