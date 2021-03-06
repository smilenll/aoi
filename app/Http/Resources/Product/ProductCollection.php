<?php

namespace App\Http\Resources\Product;


use Illuminate\Http\Resources\Json\Resource;

class ProductCollection extends Resowurce
{
    /**
     * Transform the resource collection into an array.
     *
     * @param array $request
     * @return array
     */
    public function toArray($request = [])
    {
        return [
            'name' => $this->name,
            'totalPrice' => round((1 - ($this->discount) / 100) * $this->price, 2),
            'rating' => $this->reviews->count() > 0 ? round($this->reveiws['star'] == 0 ? $this->reveiws = 1 : $this->reveiws->sum('star') / $this->reviews->count(), 2) : "No reviews yet",
            'discount' => $this->discount,
            'href' => [
                'link' => route('products.show', $this->id)
            ]
        ];
    }
}
