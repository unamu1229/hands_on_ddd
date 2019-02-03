<?php

namespace Tests;



use Domain\Model\Entity\Parking;
use Domain\Model\ValueObject\ParkingId;
use Domain\Model\ValueObject\ParkingPrice;

class ParkingTest extends \PHPUnit\Framework\TestCase
{

    /** @var Parking */
    private $parking;


    public function setUp()
    {
        parent::setUp();
        $parkingId = new ParkingId(uniqid());
        $this->parking = new Parking($parkingId);
    }


    /**
     * @expectedException \Domain\Exception\DomainException
     * expectedExceptionMessage すでに識別子が設定されています
     */
    public function testSetId()
    {
        $parkingId = new ParkingId(uniqid());
        $this->parking->setId($parkingId);
    }


    /**
     * @expectedException \Domain\Exception\DomainException
     * @expectedExceptionMessage 日貸し料金を設定しないと、時間貸しの料金は設定できません
     */
    public function testSetPriceTimeCaseUnknownPriceDay()
    {
        $parkingPrice = new ParkingPrice(3000);
        $this->parking->setPriceTime($parkingPrice);
    }


    /**
     * @expectedException \Domain\Exception\DomainException
     * expectedExceptionMessage 日貸で借りた方が得な値にしてください
     */
    public function testSetPriceTimeCasePriceTimeOverPriceDay()
    {
        $parkingPriceDay = new ParkingPrice(3000);
        $this->parking->setPriceDay($parkingPriceDay);
        $parkingPriceTime = new ParkingPrice(3000);
        $this->parking->setPriceTime($parkingPriceTime);
    }
}
