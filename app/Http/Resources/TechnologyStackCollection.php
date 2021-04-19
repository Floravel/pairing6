<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TechnologyStackCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       /* dd($this->collection->first()->pairingRequest->id);*/
/*        dd($this->collection->first());*/
        return ([
            'data' => $this->collection,
            'links' => [
                'self' => url('/technologyStack')
            ]
        ]);
    }
}
