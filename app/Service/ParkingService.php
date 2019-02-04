<?php


namespace App\Service;


use Domain\Model\Entity\Parking;
use Domain\Model\ValueObject\ParkingId;
use Domain\Model\ValueObject\ParkingSpaceId;
use Domain\Service\ParkingStateService;

class ParkingService
{
    public function parkingList()
    {
        $parkingData = parkingRepo->get();

        $parkingList = [];
        foreach ($parkingData as $p) {
            $parking = new Parking(new ParkingId($p->id));
            $parking = ParkingStateService::canUse(
                $parking,
                [$parking->parkingSpace(new ParkingSpaceId($p->space_id))]
            );
            $parkingList[] = $parking;
        }

        return $parkingList;
    }
}