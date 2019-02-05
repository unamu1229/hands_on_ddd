<?php


namespace Domain\Model\ValueObject;


class ParkingAvailable
{
    private $isCanParking;

    public function __construct($bool)
    {
        $this->isCanParking = $bool;
    }

    /**
     * @return mixed
     */
    public function getisCanParking()
    {
        return $this->isCanParking;
    }
}