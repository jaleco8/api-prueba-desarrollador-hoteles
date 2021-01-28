<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RoomResource extends JsonResource
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
            'type' => $this->getTable(),
            'id' => $this->id,
            'attributes' => [
                'name' => $this->name,
                'description' => $this->description,
                'capacity' => $this->capacity,
                'price' => $this->price,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at
            ],
            'links' => [
                'self' => route('rooms.show', ['room' => $this->id])
            ]
        ];
    }
}
