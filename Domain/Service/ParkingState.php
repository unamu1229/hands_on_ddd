<?php


namespace Domain\Service;


use Domain\Model\Entity\Parking;
use Domain\Model\ValueObject\ParkingAvailable;
use Infrastructure\ParkingSpaceRepository;

class ParkingState
{

    /**
     * 駐車場が利用可能なのか
     *
     * @param Parking $parking
     * @param ParkingSpaceRepository $parkingSpaceRepository
     * @return ParkingAvailable
     */
    public static function parkingAvailable(Parking $parking, ParkingSpaceRepository $parkingSpaceRepository)
    {
        $parkingSpace = $parkingSpaceRepository->findParkingSpace($parking->getId());

        return new ParkingAvailable($parkingSpace, $parking);
    }
}