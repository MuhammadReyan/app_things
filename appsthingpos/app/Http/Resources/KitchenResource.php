<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class KitchenResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $products = $this->product_edits($request->kitchen_display_slack);
        
        $grouped_products = $products->groupBy('product_id');

        $grouped_by_edit = $products->groupBy('edit_counter');

        $ready_to_serve_count = $products->filter(function ($value, $key) {
            return $value->is_ready_to_serve == 1;
        })->count();
        
        return [
            'slack' => $this->slack,
            'order_number' => $this->order_number,
            'kitchen_status' => new MasterStatusResource($this->kitchen_status_data),
            'order_type_data' => new MasterOrderTypeResource($this->order_type_data),
            'table' => $this->table_number,
            'product_count' => $grouped_products->count(),
            'quantity' => $products->sum('quantity'),
            'updated_at_utc' => strtotime($this->quantity_updated_on),
            'remaining_items' => ($products->count() - $ready_to_serve_count),
            'done' => ($products->count() == $ready_to_serve_count)?true:false,
            'items_grouped_by_edit_counter' => $grouped_by_edit
        ];;
    }
}
