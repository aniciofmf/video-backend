<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware(['auth:sanctum']);
    }

    public function getUser(Request $request) {
        UserResource::withoutWrapping();
        return new UserResource($request->user());
    }
}
