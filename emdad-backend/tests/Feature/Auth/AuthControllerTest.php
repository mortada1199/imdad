<?php

namespace Tests\Feature\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testcreateuser()
    {
        $response = $this->call('post','api/v1_0/users/register',[
            "name"=>'ahmed',
            "password"=>"ahmedpass",
            "email"=>"sidahmedfaisal.sf@gmail.com",
            "mobile"=>"0916619166",
            "defaultCompany"=> "1"
        ]);
        $response->assertStatus(200);
    }

    public function testcreateUserToCompany(){
        $response = $this->call('post','api/v1_0/users/createUser',[
            "name"=>'ahmed',
            "password"=>"ahmedpass",
            "email"=>"sidahmedfaisal.sf@gmail.com",
            "mobile"=>"0916619166",
            "roleId"=> "1",
            "companyId"=>"1"
        ]);
        $response->assertStatus(200);
    }

    public function testloginUser(){
        $response = $this->call('post','api/v1_0/users/login',[
            "email"=>"sidahmedfaisal.sf@gmail.com",
            "password"=>"ahmedpass",
        ]);
        $response->assertStatus(200);
    }
    public function testactivateUser(){
        $response = $this->call('post','api/v1_0/users/activate',[
            "id"=>"1",
            "otp"=>"asasjlk",
        ]);
        $response->assertStatus(200);
    }
    public function testlogoutUser(){
        $response = $this->call('post','api/v1_0/users/logout');
        $response->assertStatus(200);
    }
    public function testupdateUser(){
        $response = $this->call('post','api/v1_0/users/update',[
            "name"=>'ahmed',
            "password"=>"ahmedpass",
            "email"=>"sidahmedfaisal.sf@gmail.com",
            "mobile"=>"0916619166",
            "roleId"=> "1",
            "companyId"=>"1"
        ]);
        $response->assertStatus(200);
    }
    public function testdeleteUser(){
        $response = $this->call('delete','api/v1_0/users/delete/1');
        $response->assertStatus(301);
    }
    public function testrestoreUser(){
        $response = $this->call('put','api/v1_0/users/restore/1');
        $response->assertStatus(200);
    }
    public function testforgotPassword(){
        $response = $this->call('put','api/v1_0/users/forgot-password/1',[
        "email" =>"ahmed@gmail.com"
        ]);
        $response->assertStatus(200);
    }
    public function testresetPassword(){
        $response = $this->call('put','api/v1_0/users/reset-password',[
            'email' => 'sidahmed@gmail.com',
            'oldPassword' => 'dsklfjlsjkla',
            'newPassword' => 'sdlfkajkljsl'
        ]);
        $response->assertStatus(200);
    }
    public function testassignRole(){
        $response = $this->call('post','api/v1_0/users/assginRole',[
            'userId' => '1',
            'role' => 'anything',
            'companyId'=> '1'
        ]);
        $response->assertStatus(200);
    }
    public function testunAssignRole(){
        $response = $this->call('post','api/v1_0/users/unAssginRole',[
            'userId' => '1',
            'companyId'=> '1'
        ]);
        $response->assertStatus(200);
    }
    public function testrestoreOldRole(){
        $response = $this->call('post','api/v1_0/users/oldRole',[
            'userId' => '1',
            'companyId'=> '1'
        ]);
        $response->assertStatus(200);
    }
    public function testsetDefaultCompany(){
        $response = $this->call('post','api/v1_0/users/setDefaultCompany',[
            'userId' => '1',
            'companyId'=> '1'
        ]);
        $response->assertStatus(200);
    }
}
