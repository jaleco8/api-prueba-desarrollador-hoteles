<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
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
                'date_from' => $this->date_from, 
                'date_to' => $this->date_to, 
                'price' => $this->price,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at
            ],
            'relationships' => new BookingsRelationshipResource($this),
            'links' => [
                'self' => route('bookings.show', ['booking' => $this->id])
            ]
        ];
    }
}
