<?php

namespace App\Http\Requests\Pessoa;

use Illuminate\Foundation\Http\FormRequest;

class PessoaRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => 'required',
            'cpf' => 'required|string',
            'perfil_id' => 'required|integer',
            'curso_id' => 'nullable|integer',
            'apelido' => 'nullable|string',
            'telefone' => 'nullable',
            'email' => 'required|email',
            'senha' => 'nullable',
        ];
    }
}
