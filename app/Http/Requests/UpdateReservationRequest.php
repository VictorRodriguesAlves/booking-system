<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class UpdateReservationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'room_id' => [
                'sometimes',
                'integer',
                'exists:rooms,id'
            ],
            'start_time' => [
                'sometimes',
                'date',
                'after:now',
                'before:end_time'
            ],
            'end_time' => [
                'sometimes',
                'date',
                'after:start_time'
            ],
            'purpose' => [
                'sometimes',
                'string',
                'min:3',
                'max:255'
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'room_id.exists' => 'Sala não encontrada',
            'start_time.after' => 'A data/hora de início deve ser futura',
            'start_time.before' => 'A data/hora de início deve ser anterior ao término',
            'end_time.after' => 'A data/hora de término deve ser posterior ao início',
            'purpose.min' => 'O propósito deve ter no mínimo :min caracteres',
            'purpose.max' => 'O propósito deve ter no máximo :max caracteres'
        ];
    }
}
