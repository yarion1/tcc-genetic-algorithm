<?php

namespace App\Http\Requests\Horario;

use Illuminate\Foundation\Http\FormRequest;

class EventoRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function messages()
    {
        return  [
            'room_id' => 'O campo Local é obrigatório.',
            'course_id' => 'O campo Disciplina é obrigatório.',
            'professor_id' => 'O campo Professor é obrigatório.',
            'startTime' => 'A data de início é obrigatória',
            'endTime' => 'A data fim é obrigatória.'
        ];
    }

    public function rules(): array
    {
        return [
            'course_id' => 'required|integer',
            'horario_id' => 'required|integer',
            'startTime' => 'required|string',
            'title' => 'required|string',
            'endTime' => 'required|string',
            'daysOfWeek' => 'required|array',
            'room_id' => 'required|integer',
            'professor_id' => 'required|integer',
        ];
    }
}
