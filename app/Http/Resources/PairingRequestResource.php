<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use phpDocumentor\Reflection\Types\Resource_;

class PairingRequestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $techStacks = [];
        foreach ($this->technologyStacks as $technologyStack) {
            $techStacks[] = new TechnologyStackResource($technologyStack);
        }


        return([
            'data' => [
                'type' => 'pairing_request',
                'attributes' => [
                    'pairing_request_id' => $this->id,
                    'title' => $this->title,
                    'user_id' => $this->user->id,
                    'requested_by' => new UserResource($this->user),
                    'requested_at' =>  $this->created_at->DiffForHumans(),
                    'presentation' => $this->presentation,
                    'used_technology_stack' => new TechnologyStackCollection($this->technologyStacks),
                ]
            ],
            'links' => [
                'self' => url('/pairingRequests/'.$this->id)
            ]
        ]);
    }
}
