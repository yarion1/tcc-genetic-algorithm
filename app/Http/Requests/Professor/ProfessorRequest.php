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
            'pessoa.nome' => 'nullable|string',
            'pessoa.apelido' => 'string|nullable',
            'pessoa.cpf' => 'nullable|string',
            'pessoa.email' => 'nullable|string',
            'pessoa.senha' => 'nullable|string',
            'courses' => 'required|array',
            'carga_horaria' => 'nullable|numeric',
            'substitute' => 'boolean',
            'times' => 'nullable|array',
        ];
    }
}
