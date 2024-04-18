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
            'nome' => 'required|string',
            'sigla' => 'string',
            'tipo_sala_id' => 'required|numeric',
            'periodo' => 'required|numeric',
            'carga_horaria' => 'required|numeric',
        ];
    }
}
