<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnavailableRooms extends Model
{
    protected $table = 'unavailable_rooms';

    protected $guarded = ['id'];

    /**
     * Get the day this unavailable period exists in
     *
     * @return App\Models\Day Day
     */
    public function day()
    {
        return $this->belongsTo(Day::class, 'day_id');
    }

    /**
     * Get the timeslot this unavailable period exists in
     *
     * @return App\Models\Timeslot Timeslot
     */
    public function timeslot()
    {
        return $this->belongsTo(Timeslot::class, 'timeslot_id');
    }
}
