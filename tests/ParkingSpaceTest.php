<?php

namespace Tests;

use Domain\Model\Entity\Parking;
use Domain\Model\Entity\ParkingSpace;
use Domain\Model\ValueObject\ParkingId;
use Domain\Model\ValueObject\ParkingSpaceId;
use PHPUnit\Framework\TestCase;

class ParkingSpaceTest extends TestCase
{

    public function testCreate()
    {
        $parkingId = new ParkingId(uniqid());
        $parking = new Parking($parkingId);
        $parkingSpace = $parking->parkingSpace(new ParkingSpaceId(uniqid()));
        $this->assertTrue($parkingSpace instanceof ParkingSpace);
    }
}
