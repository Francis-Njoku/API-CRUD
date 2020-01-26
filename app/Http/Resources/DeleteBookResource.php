<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DeleteBookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);



    }

    public function with($request)
    {
        return[
            'status_code' => 204,
            'status' => 'success',
            'message' => 'The book My First Book was deleted successfully',
            'data' => [],

        ];
    }
}
