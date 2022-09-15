<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * The "data" wrapper that should be applied.
     *
     * @var string|null
     */
    public static $wrap = 'products';
    
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'sku' => $this->sku,
            'name'=> $this->name,
            'category' => $this->category->name,
            'price' => [
                'original' => $this->price,
                'final' => $this->final_price,
                'discount_percentage' => $this->discount_percentage,
                'currency' => 'EUR'
            ]
        ];
    }
}
