<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray( $request )
    {
        return [
            'user_id'          => $this->user_id,
            'customerName'     => $this->customerName,
            'customerLastName' => $this->customerLastName,
            'customerEmail'    => $this->customerEmail,
            'customerPhone'    => $this->customerPhone,
            'customerAddress'  => $this->customerAddress,
            'comment'          => $this->comment,
            'total'            => $this->total,
        ];
    }
}
