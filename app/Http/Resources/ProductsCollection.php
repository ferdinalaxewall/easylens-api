<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // dd($request);
        $response_array = [];
        foreach($this as $data){
            $response_array[] = [
                'id' => $data->id,
                'name' => $data->name,
                'description' => $data->description,
                'category' => $data->category,
                'image' => $data->image,
                'price' => [
                    'lite' => $data->lite,
                    'medium' => $data->medium,
                    'large' => $data->large
                ]
            ];
        }

        return $response_array;
    }
}
