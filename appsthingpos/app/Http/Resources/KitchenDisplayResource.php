<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Models\Category;

class KitchenDisplayResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $categories = Category::select('*')
        ->whereIn('id', explode(',', $this->categories))
        ->get();

        $category_array = $categories->pluck('slack')->toArray();

        return [
            'slack' => $this->slack,
            'kitchen_display_code' => $this->kitchen_display_code,
            'label' => $this->label,
            'category_array' => $category_array,
            'orange_timer' => $this->orange_timer,
            'red_timer' => $this->red_timer,
            'status' => new MasterStatusResource($this->status_data),
            'categories' => CategoryResource::collection($categories),
            'detail_link' => (check_access(['A_DETAIL_KITCHEN_DISPLAY'], true))?route('kitchen_display', ['slack' => $this->slack]):'',
            'created_at_label' => $this->parseDate($this->created_at),
            'updated_at_label' => $this->parseDate($this->updated_at),
            'created_by' => new UserResource($this->createdUser),
            'updated_by' => new UserResource($this->updatedUser)
        ];
    }
}
