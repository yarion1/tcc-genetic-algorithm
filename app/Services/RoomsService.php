<?php

namespace App\Services;

use App\Models\Room;

class RoomsService extends AbstractService
{
    /*
     * The model to be used by this service.
     *
     * @var \App\Models\Room
     */
    protected $model = Room::class;

    /**
     * Show resources with their relations.
     *
     * @var bool
     */
    protected $showWithRelations = true;

    public function store($data = [])
    {
        $room = Room::create([
            'name' => $data['name'],
            'capacity' => $data['capacity']
        ]);

        if (!$room) {
            return null;
        }

        if (isset($data['unavailable_rooms'])) {
            foreach ($data['unavailable_rooms'] as $period) {
                $parts = explode("," , $period);
                $dayId = $parts[0];
                $periodId = $parts[1];

                $room->unavailable_rooms()->create([
                    'day_id' => $dayId,
                    'timeslot_id' => $periodId
                ]);
            }
        }

        return $room;
    }

    /**
     * Get the room with the given id
     *
     * @param int $id The Id of the room
     */
    public function show($id)
    {
        $room = Room::find($id);
        $periods = [];

        if (!$room) {
            return null;
        }

        foreach ($room->unavailable_rooms as $period) {
            $periods[] = implode(",", [$period->day_id, $period->timeslot_id]);
        }

        $room->periods = $periods;

        return $room;
    }

    /**
     * Update the room with the given id
     * with new data
     *
     * @param int $id The id of the room
     * @param array $data Data for update
     */
    public function update($id, $data = [])
    {
        $room = Room::find($id);

        if (!$room) {
            return null;
        }

        $room->update([
            'name' => $data['name'],
            'capacity' => $data['capacity']
        ]);

        if (isset($data['unavailable_rooms'])) {
            foreach ($data['unavailable_rooms'] as $period) {
                $parts = explode("," , $period);
                $dayId = $parts[0];
                $timeslotId = $parts[1];

                $existing = $room->unavailable_rooms()
                    ->where('day_id', $dayId)
                    ->where('timeslot_id', $timeslotId)
                    ->first();

                if (!$existing) {
                    $room->unavailable_rooms()->create([
                        'day_id' => $dayId,
                        'timeslot_id' => $timeslotId
                    ]);
                }
            }

            foreach ($room->unavailable_rooms as $period) {
                if ($period->day && $period->timeslot) {
                    $periodString = implode("," , [$period->day->id, $period->timeslot->id]);
                }

                if (!isset($data['unavailable_rooms']) || !in_array($periodString, $data['unavailable_rooms'])) {
                    $period->delete();
                }
            }
        } else {
            foreach ($room->unavailable_rooms as $period) {
                $period->delete();
            }
        }

        return $room;
    }
}