<?php

namespace App\Http\Requests\Professor;

use Illuminate\Foundation\Http\FormRequest;

class ProfessorRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'courses.required' => 'O campo disciplinas é obrigatório.',
            'name.required' => 'O campo nome é obrigatório.',
        ];
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
            'name' => 'required|string',
            'carga_horaria' => 'nullable|numeric',
            'substitute' => 'boolean',
            'times' => 'nullable|array',
        ];
    }
}
