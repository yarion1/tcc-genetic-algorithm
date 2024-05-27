<?php

namespace App\Services\Horario;

use App\Repositories\Horario\NotificacaoHorarioRepository;
use App\Services\BaseService;

class NotificacaoHorarioService extends BaseService
{
    protected $repository;

    public function __construct(NotificacaoHorarioRepository $repository)
    {
        $this->repository = $repository;
    }
}
