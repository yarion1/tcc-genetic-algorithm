<?php

namespace App\Http\Requests\Sala;

use Illuminate\Foundation\Http\FormRequest;

class SalaRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'tipo_sala_id' => 'required|numeric',
            'nome_abreviado' => 'nullable|string',
            'capacity' => 'required|numeric',
        ];
    }
}
