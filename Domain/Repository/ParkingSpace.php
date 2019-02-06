<?php


namespace Domain\Repository;

use Domain\Model\ValueObject\ParkingId;


interface ParkingSpace
{
    public function findParkingSpace(ParkingId $parkingId);
}