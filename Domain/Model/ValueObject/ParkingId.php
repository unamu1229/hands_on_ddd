<?php


namespace Domain\Model\ValueObject;


class ParkingId
{
    private $id;

    public function __construct($id)
    {
        $this->id;
    }

    public function getId()
    {
        return $this->id;
    }
}