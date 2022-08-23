<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\PlanResource;
use App\Models\Plan;


class PlanController extends Controller
{
    public function getPlans() {
        return PlanResource::collection(Plan::orderBy('storage', 'asc')->get());
    }
}
