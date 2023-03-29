<?php

namespace App\Http\Controllers\User;

use App\Http\Collections\UsersProfilesCollection;
use App\Http\Controllers\Controller;
use GuzzleHttp\Psr7\Request;

class UsersProfilesController extends Controller
{
    public function index(Request $request)
    {
        return UsersProfilesCollection::collection($request);
    }
}
