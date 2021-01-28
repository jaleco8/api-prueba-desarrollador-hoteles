<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
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
                'lastname' => $this->lastname,
                'identityCard' => $this->identityCard,
                'address' => $this->address,
                'phone' => $this->phone,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at
            ],
            'links' => [
                'self' => route('clients.show', ['clients' => $this->id])
            ]
        ];
    }
}
