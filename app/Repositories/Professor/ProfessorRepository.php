<?php

namespace App\Repositories\Professor;

use App\Models\Professores;
use App\Repositories\BaseRepository;

class ProfessorRepository extends BaseRepository
{
    protected $model;

    public function __construct(Professores $model)
    {
        $this->model = $model;
    }
}
