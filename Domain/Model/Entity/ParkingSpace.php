<?php


namespace Domain\Model\Entity;


use Domain\Model\ValueObject\ParkingId;
use Domain\Model\ValueObject\ParkingSpaceId;

class ParkingSpace
{
    private $id;
    private $parkingId;


    public function __construct(ParkingSpaceId $id, ParkingId $parkingId)
    {
        $this->id = $id;
        $this->parkingId = $parkingId;
    }
}