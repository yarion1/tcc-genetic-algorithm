<?php

namespace App\Http\Requests\Professor;

use Illuminate\Foundation\Http\FormRequest;

class ProfessorRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => 'required|string',
            'apelido' => 'string|nullable',
            'courses' => 'required|array',
            'carga_horaria' => 'required|numeric',
            'cpf' => 'required|string',
            'substitute' => 'boolean',
            // 'disponibilidades' => 'required|array',
            'times' => 'nullable|array',
            'email' => 'required|string',
            'senha' => 'nullable|string',
        ];
    }
}
