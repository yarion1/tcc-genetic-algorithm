<?php

namespace App\Repositories\Configuracao;

use App\Models\ModelFront\Menu;
use App\Repositories\BaseRepository;

class MenuRepository extends BaseRepository
{

    protected $model;

    public function __construct(Menu $model)
    {
        $this->model = $model;
    }
}
