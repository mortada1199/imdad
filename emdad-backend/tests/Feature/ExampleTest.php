<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\UMController\PermissionsController;
use App\Http\Controllers\UMController\RoleController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\UMRequests\User\ActivateRequest;
use App\Http\Services\UMServices\UserServices;
use App\Http\Requests\UMRequests\User\GetUserRequest;
use App\Http\Requests\UMRequests\User\AssignRoleRequest;
use App\Http\Requests\UMRequests\User\CreateUserRequest;
use App\Http\Requests\UMRequests\User\DefaultCompanyRequest;
use App\Http\Requests\UMRequests\User\GetUserByIdRequest;
use App\Http\Requests\UMRequests\User\ResetPasswordRequest;
use App\Http\Requests\UMRequests\User\ForgotPasswordRequest;
use App\Http\Requests\UMRequests\User\RestoreUserByIdRequest;
use App\Http\Requests\UMRequests\User\UpdateRequest;
use App\Http\Controllers\Auth\MailController;
use Carbon\Carbon;
use App\Models\User;
use App\Models\UM\Role;
use App\Models\UM\RoleUserCompany;
// use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UMResources\User\UserResponse;
// use App\Http\Requests\UMRequests\User\ActivateRequest;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_application_returns_a_successful_response()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_the_AuthController_creates_a_user(){
        $response = $this->call('post','api/v1_0/users/register',[
            "name"=>'dsffds',
        ]);
        $response->assertStatus(200);
    }
}
