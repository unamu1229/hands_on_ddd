<?php


namespace Domain\Model\Entity;


use Domain\Model\ValueObject\ParkingId;
use Domain\Model\ValueObject\ParkingSpaceId;
use Domain\Model\ValueObject\ParkingSpaceStatus;

class ParkingSpace
{
    private $id;
    private $parkingId;
    /** @var ParkingSpaceStatus */
    private $status;


    public function __construct(ParkingSpaceId $id, ParkingId $parkingId)
    {
        $this->id = $id;
        $this->parkingId = $parkingId;
    }

    public function setStatus(ParkingSpaceStatus $status)
    {
        $this->status = $status;
    }

    public function status()
    {
        return $this->status->getStatus();
    }

}