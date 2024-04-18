<?php

namespace App\Repositories\Disciplina;

use App\Models\Disciplina;
use App\Repositories\BaseRepository;

class DisciplinaRepository extends BaseRepository
{
    protected $model;

    public function __construct(Disciplina $model)
    {
        $this->model = $model;
    }
}
