<?php


namespace Domain\Model\Entity;


use Domain\Exception\DomainException;
use Domain\Model\ValueObject\ParkingId;
use Domain\Model\ValueObject\ParkingPrice;
use Domain\Model\ValueObject\ParkingSpaceId;

class Parking
{

    private $id;

    private $name;

    /** @var ParkingPrice */
    private $priceDay;

    /** @var ParkingPrice */
    private $priceTime;

    private $canUse;

    private $status;


    public function __construct(ParkingId $parkingId)
    {
        $this->setId($parkingId);
    }

    public function setId(ParkingId $parkingId)
    {
        if ($this->id != null) {
            throw new DomainException('すでに識別子が設定されています');
        }

        $this->id = $parkingId;
    }


    /**
     * @param ParkingPrice $parkingPrice
     */
    public function setPriceDay(ParkingPrice $parkingPrice): void
    {
        $this->priceDay = $parkingPrice;
    }


    /**
     * @param ParkingPrice $priceTime
     */
    public function setPriceTime(ParkingPrice $priceTime): void
    {
        if ($this->priceDay == null) {
            throw new DomainException('日貸し料金を設定しないと、時間貸しの料金は設定できません');
        }

        if (($priceTime->getPrice() * 4 * 12) > $this->priceDay->getPrice()) {
            throw new DomainException('日貸で借りた方が得な値にしてください');
        }

        $this->priceTime = $priceTime;
    }


    public function parkingSpace(ParkingSpaceId $id)
    {
        return new ParkingSpace($id, $this->id);
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getCanUse()
    {
        return $this->canUse;
    }

    /**
     * @param mixed $canUse
     */
    public function setCanUse($canUse): void
    {
        $this->canUse = $canUse;
    }



}