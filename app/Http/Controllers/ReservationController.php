<?php

namespace App\Http\Controllers;

use App\Http\Requests\CancelReservationRequest;
use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Http\Resources\ReservationResource;
use App\Models\Reservation;
use App\Services\ReservationAvailabilityService;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;



class ReservationController extends Controller
{

    public function __construct(
        private readonly ReservationAvailabilityService $availabilityService
    ) {}

    public function index(): JsonResponse
    {
        $reservations = Reservation::query()
            ->with(['room:id,name,location', 'user:id,name'])
            ->orderBy('start_time')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Reservas listadas com sucesso',
            'data' => ReservationResource::collection($reservations)
        ]);
    }

    public function store(StoreReservationRequest $request): JsonResponse
    {
        if (!$this->isTimeSlotAvailable($request->validated())) {
            return $this->errorResponse(
                'Já existe uma reserva para este horário',
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        $reservation = $this->createReservation($request->validated());

        return $this->successResponse(
            'Reserva criada com sucesso',
            $reservation,
            Response::HTTP_CREATED
        );
    }

    public function cancel(Reservation $reservation, CancelReservationRequest $request): JsonResponse
    {
        try {
            if ($this->isAlreadyCancelled($reservation)) {
                return $this->errorResponse('Reserva já está cancelada');
            }

            $reservation->cancel($request->validated('cancellation_reason'));

            return $this->successResponse(
                'Reserva cancelada com sucesso',
                new ReservationResource($reservation)
            );

        } catch (\Exception $e) {
            return $this->errorResponse('Erro ao cancelar reserva');
        }
    }


    public function update(UpdateReservationRequest $request, Reservation $reservation): JsonResponse
    {
        try {
            if ($this->hasTimeSlotConflict($request->validated(), $reservation)) {
                return $this->errorResponse(
                    'Horário indisponível para reserva',
                    Response::HTTP_UNPROCESSABLE_ENTITY
                );
            }

            $reservation->update($request->validated());

            return $this->successResponse(
                'Reserva atualizada com sucesso',
                new ReservationResource($reservation)
            );
        } catch (\Exception $e) {
            return $this->errorResponse('Erro ao atualizar reserva');
        }
    }

    private function hasTimeSlotConflict(array $data, Reservation $reservation): bool
    {
        // Só verifica conflito se houver mudança de horário ou sala
        if (!$this->hasScheduleChanges($data)) {
            return false;
        }

        return !$this->availabilityService->isTimeSlotAvailable(
            roomId: $data['room_id'] ?? $reservation->room_id,
            startTime: $data['start_time'] ?? $reservation->start_time,
            endTime: $data['end_time'] ?? $reservation->end_time,
            excludeReservationId: $reservation->id
        );
    }

    private function hasScheduleChanges(array $data): bool
    {
        return isset($data['start_time'])
            || isset($data['end_time'])
            || isset($data['room_id']);
    }

    private function isTimeSlotAvailable(array $data): bool
    {
        return $this->availabilityService->isTimeSlotAvailable(
            roomId: $data['room_id'],
            startTime: $data['start_time'],
            endTime: $data['end_time']
        );
    }

    private function isAlreadyCancelled(Reservation $reservation): bool
    {
        return $reservation->status === 'cancelada';
    }

    private function createReservation(array $data): Reservation
    {
        return Reservation::query()->create($data);
    }

    private function successResponse(string $message, $data, int $status = Response::HTTP_OK): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'data' => $data
        ], $status);
    }

    private function errorResponse(string $message, int $status = Response::HTTP_BAD_REQUEST): JsonResponse
    {
        return response()->json([
            'message' => $message
        ], $status);
    }


}
