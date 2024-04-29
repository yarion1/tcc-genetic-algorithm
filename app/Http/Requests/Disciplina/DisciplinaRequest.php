<?php

namespace App\Http\Requests\Disciplina;

use Illuminate\Foundation\Http\FormRequest;

class DisciplinaRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'course_code' => 'required|string',
            'tipo_sala_id' => 'nullable|numeric',
            'periodo' => 'nullable|numeric',
            'carga_horaria' => 'nullable|numeric',
        ];
    }
}
