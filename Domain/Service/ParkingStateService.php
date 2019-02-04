<?php


namespace Domain\Service;


use Domain\Model\Entity\Parking;
use Domain\Model\Entity\ParkingSpace;

class ParkingStateService
{
    public static function canUse(Parking $parking, array $parkingSpaces)
    {
        $bool = true;
        // $parkingSpaceや$parkingの条件から
        // 利用可能か判断する。

        $parking->setCanUse($bool);

        return $parking;
    }
}