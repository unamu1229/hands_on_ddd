<?php


namespace Domain\Model\Entity;


use Domain\Exception\DomainException;
use Domain\Model\ValueObject\ParkingAvailable;
use Domain\Model\ValueObject\ParkingId;
use Domain\Model\ValueObject\ParkingPrice;
use Domain\Model\ValueObject\ParkingSpaceId;
use Domain\Model\ValueObject\ParkingSpaceStatus;
use Domain\Model\ValueObject\ParkingStatus;

class Parking
{

    private $id;

    private $name;

    /** @var ParkingPrice */
    private $priceDay;

    /** @var ParkingPrice */
    private $priceTime;

    /** @var ParkingAvailable */
    private $parkingAvailable;

    /** @var ParkingStatus */
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
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    public function priceDay()
    {
        return $this->priceDay->getPrice();
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


    public function canParking(): bool
    {
        return $this->parkingAvailable->canParking();
    }


    public function setParkingAvailable(array $parkingSpaces): void
    {
        if ($this->status() != ParkingStatus::ACTIVE) {
            $this->parkingAvailable = new ParkingAvailable(false);
        }

        foreach ($parkingSpaces as $parkingSpace) {
            if ($parkingSpace->status() == ParkingSpaceStatus::ACTIVE) {
                $this->parkingAvailable = new ParkingAvailable(true);
            }
        }

        $this->parkingAvailable = new ParkingAvailable(false);
    }

    /**
     * @param mixed $status
     */
    public function setStatus(ParkingStatus $status): void
    {
        $this->status = $status;
    }

    public function status()
    {
        return $this->status->getStatus();
    }


}