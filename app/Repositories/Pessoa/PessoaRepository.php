<?php

namespace App\Repositories\Pessoa;

use App\Models\ModelFront\Pessoa;
use App\Repositories\BaseRepository;

class PessoaRepository extends BaseRepository
{
    protected $model;

    public function __construct(Pessoa $model)
    {
        $this->model = $model;
    }
}
