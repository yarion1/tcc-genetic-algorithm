<?php

namespace App\Http\Requests\Turma;

use Illuminate\Foundation\Http\FormRequest;

class TurmaRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => 'required|string',
            'tipo_turma' => 'required|string',
            'periodo' =>'required|numeric',
            'quantidade_alunos' =>'required|numeric',
            'cor_destaque' => ['required', 'regex:/([a-f]|[A-F]|[0-9]){3}(([a-f]|[A-F]|[0-9]){3})?\b/']
            //
        ];
    }
}
