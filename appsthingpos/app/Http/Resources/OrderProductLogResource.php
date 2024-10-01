<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderProductLogResource extends JsonResource
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
            'slack' => $this->slack,
            'product_id' => $this->product_id,
            'product_code' => $this->product_code,
            'name' => $this->name,
            'quantity' => $this->quantity,
            'is_ready_to_serve' => $this->is_ready_to_serve,
            'edit_counter' => $this->edit_counter,
            'quantity_reduced' => $this->quantity_reduced,
            'previous_quantity' => $this->previous_quantity,
            'created_at_label' => $this->parseDate($this->created_at),
            'updated_at_label' => $this->parseDate($this->updated_at),
            'created_at_utc' => strtotime($this->created_at),
            'duration' => $this->duration($this->created_at),
        ];
    }
}