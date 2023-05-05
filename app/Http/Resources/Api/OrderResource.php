<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'order_detail' => OrderDetailResource::collection($this->whenLoaded('order_detail')),
            'order_status' => $this->whenLoaded('order_status'),
            'payment' => $this->whenLoaded('payment'),
            'token_id' => $this->token_id,
            'user_name' => $this->user_name,
            'phone_number' => $this->phone_number,
            'total' => $this->total,
            'status_payment' => $this->status_payment,
            'today' => $this->getToday($this->created_at),
        ];
    }
    private function getToday($created_at)
    {
        $now = Carbon::now();
        $createdDate = Carbon::parse($created_at)->startOfDay();
        return $createdDate->equalTo($now->startOfDay());
    }
}
