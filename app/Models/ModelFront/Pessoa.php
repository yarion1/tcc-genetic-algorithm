<?php

namespace App\Models\ModelFront;

use App\Http\Middleware\Authenticate;
use App\Models\ModelFront\Base\BaseModel;
use App\Models\ModelFront\Base\BaseModelAuth;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Pessoa extends BaseModelAuth

{     

    protected $fillable = [
        'id',
        'nome',
        'email',
        'cpf',
        'senha',
        'apelido',
        'foto',
        'fone',
        'perfil_id'
    ];

    protected $appends = ['select_text', 'select_text_short'];

    protected $hidden = [
        'email_verified_at',
        'senha',
        'remember_token',
    ];

    function regexcpf(string $cpf): string
    {
        $formatado = preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $cpf);
        return $formatado;
    }

    protected function cpf(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => $this->regexcpf($value),
        );
    }

    function regexTelefone(string $fone = null): string|null
    {
        if (!$fone) return $fone;

        $fone = preg_replace('/[^0-9]/', '', $fone);

        $tam = strlen(preg_replace("/[^0-9]/", "", $fone));
        if ($tam == 13) { // COM CÓDIGO DE ÁREA NACIONAL E DO PAIS e 9 dígitos
            return "+" . substr($fone, 0, $tam - 11) . "(" . substr($fone, $tam - 11, 2) . ")" . substr($fone, $tam - 9, 5) . "-" . substr($fone, -4);
        }
        if ($tam == 12) { // COM CÓDIGO DE ÁREA NACIONAL E DO PAIS
            return "+" . substr($fone, 0, $tam - 10) . "(" . substr($fone, $tam - 10, 2) . ")" . substr($fone, $tam - 8, 4) . "-" . substr($fone, -4);
        }
        if ($tam == 11) { // COM CÓDIGO DE ÁREA NACIONAL e 9 dígitos
            return "(" . substr($fone, 0, 2) . ")" . substr($fone, 2, 5) . "-" . substr($fone, 7, 11);
        }
        if ($tam == 10) { // COM CÓDIGO DE ÁREA NACIONAL
            return "(" . substr($fone, 0, 2) . ")" . substr($fone, 2, 4) . "-" . substr($fone, 6, 10);
        }
        if ($tam <= 9) { // SEM CÓDIGO DE ÁREA
            return substr($fone, 0, $fone - 4) . "-" . substr($fone, -4);
        }
    }

    protected function telefone(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => $this->regexTelefone($value),
        );
    }

    public function curso(): BelongsTo
    {
         return $this->belongsTo(Curso::class, 'curso_id');
    }

    public function professor(): HasOne
    {
         return $this->HasOne(Professores::class, 'pessoa_id');
    }

    public function perfil(): BelongsTo
    {
         return $this->belongsTo(Perfil::class, 'perfil_id');
    }

    protected function selectText(): Attribute
    {
        return new Attribute(
            get: fn () => $this->id . ' - ' . $this->nome . ' - ' . $this->cpf,
        );
    }

    protected function selectTextShort(): Attribute
    {
        return new Attribute(
            get: fn () =>  $this->cpf ? $this->cpf . ' - ' . $this->nome : $this->nome,
        );
    }

}
