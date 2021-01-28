<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookingsRelationshipResource extends JsonResource
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
            'client' => [
                'links' => [
                    'self' => route('bookings.relationships.client', ['booking' => $this]),
                    'related' => route('bookings.client', ['booking' => $this])
                ],
                'data' => new ClientIdentifierResource($this->client)
            ],
            'room' => [
                'links' => [
                    'self' => route('bookings.relationships.room', ['booking' => $this]),
                    'related' => route('bookings.room', ['booking' => $this])
                ],
                'data' => new RoomIdentifierResource($this->room)
            ],
        ];
    }
}
