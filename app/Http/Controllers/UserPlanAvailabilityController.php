<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;
use App\Http\Resources\PlanResource;

class UserPlanAvailabilityController extends Controller
{
    public function __construct() {
        $this->middleware(['auth:sanctum']);
    }

    public function getPlans(Request $request) {
        return [
            'data' => Plan::orderBy('storage', 'asc')->get()->flatMap(function($plan) use($request) {
                return [
                    array_merge(
                        (new PlanResource($plan))->toArray($request),
                        ['can_downgrade' => $request->user()->canDowngradeToPlan($plan)]
                    )                    
                ];
            })
        ];
    }
}
