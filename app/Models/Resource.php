<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    /**
     * Get the rooms that have this resource.
     */
    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'room_resources');
    }
}
