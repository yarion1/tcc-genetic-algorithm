<?php

namespace App\Http\Requests\Horario;

use Illuminate\Foundation\Http\FormRequest;

class HorarioRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'versao' => 'required|string',
            'semestre' => 'required|numeric',
            'horario.*.periodo' => 'required|numeric',
        ];
    }
}
