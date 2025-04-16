<?php

namespace App\Http\Requests;

use App\Models\Reservation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreReservationRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => [
                'required',
                'integer',
                'exists:users,id'
            ],
            'room_id' => [
                'required',
                'integer',
                'exists:rooms,id'
            ],
            'start_time' => [
                'required',
                'date',
                'after:now',
                'before:end_time'
            ],
            'end_time' => [
                'required',
                'date',
                'after:start_time'
            ],
            'purpose' => [
                'required',
                'string',
                'min:3',
                'max:255'
            ],
            'status' => [
                'sometimes',
                Rule::in(['agendada', 'concluida', 'cancelada']),
                'default:agendada'
            ],
            'cancellation_reason' => [
                'nullable',
                'string',
                'max:255'
            ],
            'approved' => [
                'sometimes',
                'boolean',
                'default:false'
            ],
            'approved_by' => [
                'nullable',
                'integer',
                'exists:users,id'
            ]
        ];
    }


    public function messages(): array
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'exists' => ':attribute não encontrado',
            'date' => ':attribute inválida',
            'after' => ':attribute deve ser futura',
            'before' => ':attribute deve ser anterior ao término',
            'min' => ':attribute deve ter no mínimo :min caracteres',
            'max' => ':attribute deve ter no máximo :max caracteres',
            'in' => ':attribute inválido'
        ];
    }

}
