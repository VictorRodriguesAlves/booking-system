<?php

namespace App\Services;

use App\Models\Reservation;
use Carbon\Carbon;

class ReservationAvailabilityService
{
    /**
     * Verifica se um horário está disponível para uma sala específica
     *
     * @param int $roomId ID da sala
     * @param string|Carbon $startTime Horário de início
     * @param string|Carbon $endTime Horário de término
     * @param int|null $excludeReservationId ID da reserva a ser excluída da verificação (usado para updates)
     * @return bool true se o horário estiver disponível, false se houver conflito
     */
    public function isTimeSlotAvailable(
        int $roomId,
        string|Carbon $startTime,
        string|Carbon $endTime,
        ?int $excludeReservationId = null
    ): bool
    {

        if (!$startTime instanceof Carbon) {
            $startTime = Carbon::parse($startTime);
        }

        if (!$endTime instanceof Carbon) {
            $endTime = Carbon::parse($endTime);
        }

        $query = Reservation::query()
            ->where('room_id', $roomId)
            ->where('status', '!=', 'cancelled');

        if ($excludeReservationId) {
            $query->where('id', '!=', $excludeReservationId);
        }

        $conflict = $query->where(function ($query) use ($startTime, $endTime) {
            $query->whereBetween('start_time', [$startTime, $endTime])
                ->orWhereBetween('end_time', [$startTime, $endTime])
                ->orWhere(function ($q) use ($startTime, $endTime) {
                    $q->where('start_time', '<=', $startTime)
                        ->where('end_time', '>=', $endTime);
                });
        })->exists();

        return !$conflict;
    }

}
