<?php

namespace App\Repositories\Turma;

use App\Models\ModelFront\Turma;
use App\Repositories\BaseRepository;

class TurmaRepository extends BaseRepository
{
    protected $model;

    public function __construct(Turma $model)
    {
        $this->model = $model;
    }
}
