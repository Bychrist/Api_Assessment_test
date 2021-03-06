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
        return  [

            "name" => $this->name,
            "isbn" => $this->isbn,
            "country" => $this->country,
            "number_of_pages" => $this->number_of_pages,
            "publisher" => $this->publisher,
            "authors" => $this->authors,
            "release_date" => $this->release_date

        ];

        
        
    }
}
