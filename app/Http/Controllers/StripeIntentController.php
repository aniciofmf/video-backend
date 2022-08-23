<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StripeIntentController extends Controller
{
    public function __construct() {
        $this->middleware(['auth:sanctum']);
    }

    public function getClientSecret(Request $request) {
        return [
            'data' => [
                'client_secret' => $request->user()->createSetupIntent()->client_secret
            ]
        ];
    }
}
