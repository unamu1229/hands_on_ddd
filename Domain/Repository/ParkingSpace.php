<?php


namespace Domain\Repository;

use Domain\Model\ValueObject\ParkingId;


interface ParkingSpace
{
    /**
     * @param ParkingId $parkingId
     * @return \Domain\Model\Entity\ParkingSpace[]
     */
    public function findParkingSpace(ParkingId $parkingId);
}