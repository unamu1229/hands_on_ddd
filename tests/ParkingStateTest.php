<?php

namespace Tests;

use Domain\Model\Entity\Parking;
use Domain\Model\ValueObject\ParkingId;
use Domain\Model\ValueObject\ParkingStatus;
use Domain\Service\ParkingState;
use Infrastructure\ParkingSpaceRepository;
use PHPUnit\Framework\TestCase;
use Domain\Model\Entity\ParkingSpace;
use Domain\Model\ValueObject\ParkingSpaceId;
use Domain\Model\ValueObject\ParkingSpaceStatus;

class ParkingStateTest extends TestCase
{
    public function testParkingAvailable()
    {
        $parking = new Parking(new ParkingId(uniqid()));
        $parking->setStatus(new ParkingStatus(ParkingStatus::ACTIVE));
        $mock = \Mockery::mock(ParkingSpaceRepository::class);

        $parkingSpace = new ParkingSpace(new ParkingSpaceId(uniqid()), $parking->getId());
        $parkingSpace->setStatus(new ParkingSpaceStatus(ParkingSpaceStatus::ACTIVE));
        $mock->shouldReceive('findParkingSpace')->with($parking->getId())
            ->andReturn([$parkingSpace]);

        $parkingAvailable = ParkingState::parkingAvailable($parking, $mock);

        $this->assertTrue($parkingAvailable->canParking());
    }
}
