<?php

namespace App\Repositories\Disciplina;

use App\Models\Course;
use App\Repositories\BaseRepository;

class DisciplinaRepository extends BaseRepository
{
    protected $model;

    public function __construct(Course $model)
    {
        $this->model = $model;
    }
}
