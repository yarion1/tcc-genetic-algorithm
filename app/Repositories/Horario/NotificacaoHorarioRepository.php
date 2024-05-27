<?php

namespace App\Repositories\Horario;

use App\Models\NotificacaoHorario;
use App\Repositories\BaseRepository;

class NotificacaoHorarioRepository extends BaseRepository
{
    protected $model;

    public function __construct(NotificacaoHorario $model)
    {
        $this->model = $model;
    }
}
