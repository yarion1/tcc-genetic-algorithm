<?php

namespace App\Models\ModelFront\Base;

use App\Models\ModelFront\Pessoa;
use App\Models\ModelFront\Scopes\ActiveScope;
use App\Models\ModelFront\Scopes\OrderScope;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use \OwenIt\Auditing\Auditable;

class BaseModelCommom extends Model implements AuditableContract
{
    use SoftDeletes, Auditable;

    const CREATED_AT = 'criado_em';
    const UPDATED_AT = 'atualizado_em';
    const DELETED_AT = 'excluido_em';

    public function usuarioCadastro(): BelongsTo
    {
        return $this->belongsTo(Pessoa::class, 'criado_por')->select('id', 'nome');
    }

    public function usuarioAlteracao(): BelongsTo
    {
        return $this->belongsTo(Pessoa::class, 'atualizado_por')->select('id', 'nome');
    }

    public function usuarioExclusao(): BelongsTo
    {
        return $this->belongsTo(Pessoa::class, 'excluido_por')->select('id', 'nome', 'foto', 'cpf');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d/m/Y H:i:s');
    }

    private static function deleteRelatedModels($model)
    {
        if (isset($model->cascadeDelete)) {

            collect($model->cascadeDelete)->each(function ($relation) use ($model) {
                if (is_countable($model->$relation)) {
                    collect($model->$relation)->each(function ($model) {
                        if (isset($model->cascadeDelete)) {
                            $model::deleteRelatedModels($model);
                        }
                        $model->delete();
                    });
                } else {
                    $model = $model->$relation;

                    if (isset($model->cascadeDelete)) {
                        $model::deleteRelatedModels($model);
                    }
                    $model->delete();
                }
            });
        }
    }
    protected static function booted(): void
    {
        static::addGlobalScope(new ActiveScope);
        static::addGlobalScope(new OrderScope);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->criado_por = auth()->user()->id ?? null;
        });

        static::updating(function ($model) {
            $model->atualizado_por = auth()->user()->id;
        });

        static::deleting(function ($model) {
            // CASCADE SOFT DELETE
            $model::deleteRelatedModels($model, 0);
            $model->excluido_por = auth()->user()->id;
            $model->update();
        });

        static::restoring(function ($model) {
            $model->excluido_por = null;
        });
    }
}
