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
            'disciplinas' => 'required|array',
            'carga_horaria' => 'required|numeric',
            'cpf' => 'required|string',
            // 'disponibilidades' => 'required|array',
            // 'prioridades' => 'required|array',
            'email' => 'required|string',
            'senha' => 'nullable|string',
        ];
    }
}
