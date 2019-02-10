<?php


namespace Domain\Service;


use Domain\Model\Entity\Parking;
use Domain\Repository\ParkingSpace;

class ParkingState
{

    /**
     * 駐車場が利用可能なのか
     *
     * @param Parking $parking
     * @param ParkingSpace $parkingSpaceRepository
     */
    public static function parkingAvailable(Parking $parking, ParkingSpace $parkingSpaceRepository)
    {
        $parkingSpaces = $parkingSpaceRepository->findParkingSpace($parking->getId());

        $parking->setParkingAvailable($parkingSpaces);
    }
}