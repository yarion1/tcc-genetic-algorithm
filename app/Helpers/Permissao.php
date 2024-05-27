<?php

use Illuminate\Support\Facades\Auth;

function permissaoCoordenador()
{
    return !Auth::user()->perfil_id ?? 1;
}