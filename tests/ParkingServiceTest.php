<?php

namespace Tests;

use App\Service\ParkingService;
use Infrastructure\ParkingRepository;
use Infrastructure\ParkingSpaceRepository;
use PHPUnit\Framework\TestCase;
use Domain\Model\ValueObject\ParkingSpaceStatus;
use Domain\Model\Entity\ParkingSpace;
use Domain\Model\ValueObject\ParkingSpaceId;
use Domain\Model\Entity\Parking;
use Domain\Model\ValueObject\ParkingId;
use Domain\Model\ValueObject\ParkingStatus;


class ParkingServiceTest extends TestCase
{
    public function testParkingList()
    {
        $parking = new Parking(new ParkingId(uniqid()));
        $parking->setStatus(new ParkingStatus(ParkingStatus::ACTIVE));

        $mockParkingSpaceRepo = \Mockery::mock(ParkingSpaceRepository::class);
        $parkingSpace = new ParkingSpace(new ParkingSpaceId(uniqid()), $parking->getId());
        $parkingSpace->setStatus(new ParkingSpaceStatus(ParkingSpaceStatus::ACTIVE));
        $mockParkingSpaceRepo->shouldReceive('findParkingSpace')->with($parking->getId())
            ->andReturn([$parkingSpace]);

        $mockParkingRepo = \Mockery::mock(ParkingRepository::class);
        $mockParkingRepo->shouldReceive('all')->andReturn([$parking]);

        $parkingService = new ParkingService($mockParkingRepo, $mockParkingSpaceRepo);
        $parkingList = $parkingService->parkingList();

        $this->assertTrue($parkingList[0]->canParking());
    }
}
