<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'description' => $this->detail,
            'price' => $this->price,
            'total price' => round((1 - ($this->discount) / 100) * $this->price, 2),
            'stock' => $this->stock == 0 ? 'Out of stoke' : $this->stock,
            'discount' => $this->discount,
            'rating' => $this->reviews->count() > 0 ? round($this->reveiws['star'] == 0 ? $this->reveiws = 1 : $this->reveiws->sum('star') / $this->reviews->count(), 2) : "NO reviews yet",
            'href' => [
                'reviews' => route('reviews.index', $this->id)
            ]

        ];
    }
}
