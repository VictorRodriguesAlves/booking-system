<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomResource extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'resource_id'
    ];

}
