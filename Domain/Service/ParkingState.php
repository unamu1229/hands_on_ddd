<?php


namespace Domain\Service;


use Domain\Model\Entity\Parking;
use Domain\Model\ValueObject\ParkingAvailable;
use Domain\Model\ValueObject\ParkingSpaceStatus;
use Domain\Model\ValueObject\ParkingStatus;
use Domain\Repository\ParkingSpace;
use Infrastructure\ParkingSpaceRepository;

class ParkingState
{

    /**
     * 駐車場が利用可能なのか
     *
     * @param Parking $parking
     * @param ParkingSpace $parkingSpaceRepository
     * @return ParkingAvailable
     */
    public static function parkingAvailable(Parking $parking, ParkingSpace $parkingSpaceRepository)
    {
        $parkingSpaces = $parkingSpaceRepository->findParkingSpace($parking->getId());

        if ($parking->status() != ParkingStatus::ACTIVE) {
            return new ParkingAvailable(false);
        }

        foreach ($parkingSpaces as $parkingSpace) {
            if ($parkingSpace->status() == ParkingSpaceStatus::ACTIVE) {
                return new ParkingAvailable(true);
            }
        }

        return new ParkingAvailable(false);
    }
}