<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TechnologyStackResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => [
                'type' => 'technology_stack',
                'technology_stack_id' => $this->id,
                'attributes' => [
                    'name' => $this->name,
                ],
                'links' => [
                    'self' => url('/technologyStacks/'.$this->id),
                ]
            ]
        ];
    }
}
