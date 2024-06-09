<?php

namespace App\Models;

use App\Models\ModelFront\TiposSalas;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    /**
     * DB table this model uses
     *
     * @var string
     */
    protected $table = 'rooms';

    /**
     * Fields to be protected from mass assignment
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Declare a relationship between this room and the courses
     * that are allowed to use this room
     *
     * @return Illuminate\Database\Eloquent
     */
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'favourite_rooms', 'room_id', 'course_id');
    }

    public function unavailable_rooms()
    {
        return $this->hasMany(UnavailableRooms::class, 'room_id');
    }

    public function tipoSala()
    {
        return $this->belongsTo(TiposSalas::class);
    }
    
    public function schedules() : HasMany
    {
        return $this->hasMany(ProfessorSchedule::class);
    }
}
