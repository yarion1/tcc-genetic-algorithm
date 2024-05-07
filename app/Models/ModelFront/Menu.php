<?php

namespace App\Models\ModelFront;

use App\Models\ModelFront\Base\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Support\Facades\DB;

class Menu extends BaseModel
{
    protected $fillable = ['label', 'raiz', 'icon', 'label', 'ativo'];
    protected $hidden = ['pivot'];

    protected $casts = [
        'ativo' => 'boolean'
    ];

    public $cascadeDelete = [
        'menuPerfil',
        'items'

    ];


    public function items(): HasMany
    {
        return $this->hasMany(Menu::class, 'raiz')->select('id', 'label', 'raiz', 'icon')->with('pai')->orderBy('id', 'asc');
    }
    
    public function pai(): BelongsTo
    {
        return $this->belongsTo(Menu::class, 'raiz')->select('id', 'label', 'raiz');
    }

    public function menuPerfil(): HasMany
    {
        return $this->hasMany(MenuPerfil::class);
    }

}
