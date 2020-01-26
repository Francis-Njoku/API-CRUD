<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NoResultResource extends JsonResource
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


        return[
            'status_code' => 200,
            'status' => 'success',
            'data' => [ ],
        ];
    }

    public function with($request)
    {
        return [
            'version' => '1.0.0',
            'author_url' => ('https://nairametrics.com')
        ];
    }
}
