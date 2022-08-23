<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class ChangePasswordController extends Controller
{
    public function __construct() {
        $this->middleware(['auth:sanctum']);
    }

    public function changePassword(ChangePasswordRequest $request) {
        if (Hash::check($request->password, $request->user()->password)) {
            
            $user = User::find($request->user()->id);

            $user->password = Hash::make($request->new_password);

            $user->save();

            return response(null, 200);
        }

        return response(["errors" => ["password" => ["La contraseña actual es incorrecta."]]], 422);
    }
}
