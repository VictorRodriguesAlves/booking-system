<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user' => $this->user->name,
            'room' => [
                'name' => $this->room->name,
                'location' => $this->room->location
            ],
            'start_time' => Carbon::parse($this->start_time)->format('d/m/Y H:i:s'),
            'end_time' => Carbon::parse($this->end_time)->format('d/m/Y H:i:s'),
            'purpose' => $this->purpose,
            'status' => $this->status,
            'cancellation_reason' => $this->cancellation_reason,
            'approved' => $this->approved,
            'approved_by' => $this->approved_by,
            'created_at' => Carbon::parse($this->created_at)->format('d/m/Y H:i:s'),
            'updated_at' => Carbon::parse($this->updated_at)->format('d/m/Y H:i:s'),
        ];
    }

}
