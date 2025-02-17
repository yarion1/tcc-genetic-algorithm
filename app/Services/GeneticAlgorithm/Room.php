<?php
namespace App\Services\GeneticAlgorithm;

use App\Models\Room as RoomModel;

class Room
{
    /**
     * ID assigned to room
     *
     * @var int
     */
    private $roomId;

    /**
     * Model of room from database
     *
     * @var string
     */
    private $model;

    /**
     * Create a new room
     *
     * @param int $roomId ID of room
     * @param array $occupiedSlots Timeslots that the room is not available
     */
    public function __construct($roomId, $occupiedSlots)
    {
        $this->roomId = $roomId;
        $this->model = RoomModel::find($roomId);
        $this->occupiedSlots = $occupiedSlots;
    }

    /**
     * Get the Id of the room
     *
     * @return int ID of room
     */
    public function getId()
    {
        return $this->roomId;
    }

    /**
     * Get the room's number
     *
     * @return string Room number
     */
    public function getRoomNumber()
    {
        return $this->model->name;
    }

    /**
     * Get the capacity of the room
     *
     * @return int The capacity of the room
     */
    public function getCapacity()
    {
        return $this->model->capacity;
    }

    public function getOccupiedSlots()
    {
        return $this->occupiedSlots;
    }
}