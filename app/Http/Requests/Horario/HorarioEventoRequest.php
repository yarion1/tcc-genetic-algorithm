<?php

namespace App\Http\Requests\Horario;

use Illuminate\Foundation\Http\FormRequest;

class HorarioEventoRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // 'local' => 'required|array',
            'disciplina_id' => 'required|integer',
            'horario_id' => 'required|integer',
            'startTime' => 'required|string',
            'title' => 'required|string',
            'endTime' => 'required|string',
            'daysOfWeek' => 'required|array',
        ];
    }
}
