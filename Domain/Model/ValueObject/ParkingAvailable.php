<?php


namespace Domain\Model\ValueObject;


use Domain\Model\Entity\Parking;
use Domain\Model\Entity\ParkingSpace;

class ParkingAvailable
{
    /** @var ParkingSpace[] */
    private $parkingSpace;

    /** @var Parking */
    private $parking;

    public function __construct(array $parkingSpace, Parking $parking)
    {
        $this->parkingSpace = $parkingSpace;
        $this->parking = $parking;
    }

    public function canParking()
    {
        // $parkingSpaceや$parkingの条件から
        // 利用可能か判断する。

        return true;
    }
}