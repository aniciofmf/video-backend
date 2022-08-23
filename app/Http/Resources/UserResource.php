<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'ends_at' => optional(optional($this->subscription('default'))->ends_at)->toDateTimeString(),
            'subscribed' => $this->subscribed('default'),
            'plan' => new PlanResource($this->plan)
        ];
    }
}
