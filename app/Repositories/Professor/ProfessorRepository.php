<?php

namespace App\Repositories\Professor;

use App\Models\Professor;
use App\Repositories\BaseRepository;

class ProfessorRepository extends BaseRepository
{
    protected $model;

    public function __construct(Professor $model)
    {
        $this->model = $model;
    }
}
