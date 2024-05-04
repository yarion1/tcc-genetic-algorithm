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
            'college_class_id' => 'required|numeric',
            'carga_horaria' => 'nullable|numeric',
            'quantidade_alunos' => 'nullable|numeric',
        ];
    }
}
