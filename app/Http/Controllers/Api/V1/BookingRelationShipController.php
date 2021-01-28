<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ClientResource;
use App\Http\Resources\RoomResource;
use App\Models\Booking;

class BookingRelationShipController extends Controller
{
    public function client(Booking $booking)
    {
        ClientResource::withoutWrapping();
        return new ClientResource($booking->client);
    }

    public function room(Booking $booking)
    {
        RoomResource::withoutWrapping();
        return new RoomResource($booking->room);
    }
}
