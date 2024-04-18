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
            'nome' => 'required|string',
            'tipo_sala_id' => 'required|numeric',
            'capacidade' => 'required|numeric',
        ];
    }
}
