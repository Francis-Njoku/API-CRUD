<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
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
            'data' => [
            //'data' => $this->collection,
            'id' => $this->id,
            'name' => $this->name,
            'isbn' => $this->isbn,
            'authors' => [
                $this->authors
            ],
            'number_of_pages' => $this->number_of_pages,
            'publisher' => $this->publisher,
            'country' => $this->country,
            'release_date' => $this->release_date,
                ]


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
