<?php

namespace App\Models\ModelFront;

use App\Models\ModelFront\Base\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MenuPerfil extends BaseModel
{
    protected $table = 'menu_perfis';

    protected $fillable = ['menu_id', 'perfil_id'];


    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }

   
}
