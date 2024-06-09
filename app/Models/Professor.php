<?php

namespace App\Models;

use App\Models\ModelFront\Pessoa;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class Professor extends Model
{
    use Notifiable;

    /**
     * DB table this model uses
     *
     * @var string
     */
    
    protected $table = 'professors';
    /**
     * Non-mass assignable fields
     */
    protected $guarded = [
        'id',
        'ativo',
        'criado_por',
        'criado_em',
        'atualizado_por',
        'atualizado_em',
        'excluido_por',
        'excluido_em'
    ];

    public $cascadeDelete = [
      'coursesProfessors'
    ];

    /**
     * Declare relationship between a professor and the courses
     * he or she teaches
     *
     * @return Illuminate\Database\Eloquent
     */
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'courses_professors', 'professor_id', 'course_id');
    }

    /**
     * Declare relationship between a professor and the timeslots that he or she
     * is not available
     *
     * @return Illuminate\Database\Eloquent
     */
    public function unavailable_timeslots()
    {
        return $this->hasMany(UnavailableTimeslot::class, 'professor_id');
    }

    public function pessoa(): BelongsTo
    {
        return $this->BelongsTo(Pessoa::class, 'pessoa_id');
    }

    public function schedule(): HasMany
    {
        return $this->HasMany(ProfessorSchedule::class, 'professor_id');
    }

    public function coursesProfessors(): HasMany
    {
        return $this->HasMany(CoursesProfessor::class, 'professor_id');
    }

    // public function disciplinas(): HasMany
    // {
    //     return $this->hasMany(Course::class, 'professor_id');
    // }

    // public function disponibilidades(): HasMany
    // {
    //     return $this->hasMany(DisponibilidadesProfessores::class, 'professor_id');
    // }

    // public function prioridades(): HasMany
    // {
    //     return $this->hasMany(PrioridadesProfessores::class, 'professor_id');
    // }
}
