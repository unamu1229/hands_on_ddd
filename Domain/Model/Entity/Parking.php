<?php


namespace Domain\Model\Entity;


use Domain\Model\ValueObject\ParkingId;
use Domain\Model\ValueObject\ParkingPrice;

class Parking
{
    private $id;

    private $name;

    private $priceDay;

    private $priceTime;

    public function __construct(ParkingId $parkingId)
    {
        $this->setId($parkingId);
    }

    public function setId(ParkingId $parkingId)
    {
        if ($this->id != null) {
            throw new \InvalidArgumentException('すでに識別子が設定されています');
        }

        $this->id = $parkingId;
    }

    /**
     * @param mixed $priceDay
     */
    public function setPriceDay(ParkingPrice $parkingPrice): void
    {
        $this->priceDay = $parkingPrice;
    }

    /**
     * @param mixed $priceTime
     */
    public function setPriceTime(ParkingPrice $priceTime): void
    {
        if ($this->priceDay != null) {
            throw new \InvalidArgumentException('まずは、日貸し料金を設定してください');
        }

        if (($priceTime->getPrice() * 4 * 12) > $this->priceDay->getPrice) {
            throw new \InvalidArgumentException('日貸で借りた方が得な値にしてください');
        }

        $this->priceTime = $priceTime;
    }







}