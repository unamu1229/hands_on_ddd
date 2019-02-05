<?php


namespace Domain\Model\ValueObject;


class ParkingAvailable
{
    private $canParking;

    public function __construct($bool)
    {
        $this->canParking = $bool;
    }

    /**
     * @return mixed
     */
    public function canParking()
    {
        return $this->canParking;
    }
}