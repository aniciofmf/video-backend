<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;
use App\Http\Requests\SubscriptionRequest;
use App\Http\Requests\SubscriptionSwapRequest;


class SubscriptionController extends Controller
{
    public function __construct() {
        $this->middleware(['auth:sanctum']);
        $this->middleware(['subscribed'])->only('swapSubscription');

    }

    public function createSubscription(SubscriptionRequest $request) {
        
        $plan = Plan::whereSlug($request->plan)->first();        

        $request->user()->newSubscription('default', $plan->stripe_id)
            ->create($request->token);
    }

    public function swapSubscription(SubscriptionSwapRequest $request) {

        $plan = Plan::whereSlug($request->plan)->first();

        if (!$request->user()->canDowngradeToPlan($plan)) {
            return response("error", 400);
        }

        if ($plan->is_free) {
            $request->user()->subscription('default')->cancel();
            return;
        }

        $request->user()->subscription('default')->swap($plan->stripe_id);

    }
}
