<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date_from', 'date_to', 'price', 'client_id', 'rooms_id'
    ];

    public function client() 
    {
        return $this->belongsTo('App\Models\Client', 'client_id');
    }

    public function room() 
    {
        return $this->belongsTo('App\Models\Room', 'rooms_id');
    }


}
