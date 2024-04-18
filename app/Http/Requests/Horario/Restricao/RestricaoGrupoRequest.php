<?php

namespace App\Http\Requests\Horario\Restricao;

use Illuminate\Foundation\Http\FormRequest;

class RestricaoGrupoRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            //
        ];
    }
}
