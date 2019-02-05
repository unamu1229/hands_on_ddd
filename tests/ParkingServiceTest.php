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


    /**
     * 負荷テスト
     * 駐車場1000個、各駐車場に車室100の場合で1秒以下か
     */
    public function testParkingListCaseStress()
    {
        $timeStart = microtime(true);

        $parkings = [];
        for ($i = 0; $i < 1000; $i++) {
            $parking = new Parking(new ParkingId(uniqid()));
            $parking->setStatus(new ParkingStatus(ParkingStatus::ACTIVE));
            $parkings[] = $parking;
        }

        $parkingSpaces = [];
        for ($i = 0; $i < 100; $i++) {
            $parkingSpace = new ParkingSpace(new ParkingSpaceId(uniqid()), $parking->getId());
            if ($i == 99) {
                $parkingSpace->setStatus(new ParkingSpaceStatus(ParkingSpaceStatus::ACTIVE));
                $parkingSpaces[] = $parkingSpace;
                continue;
            }
            $parkingSpace->setStatus(new ParkingSpaceStatus(ParkingSpaceStatus::STOP));
            $parkingSpaces[] = $parkingSpace;
        }


        $mockParkingSpaceRepo = \Mockery::mock(ParkingSpaceRepository::class);
        $mockParkingSpaceRepo->shouldReceive('findParkingSpace')->andReturn($parkingSpaces);

        $mockParkingRepo = \Mockery::mock(ParkingRepository::class);
        $mockParkingRepo->shouldReceive('all')->andReturn($parkings);

        $parkingService = new ParkingService($mockParkingRepo, $mockParkingSpaceRepo);
        $parkingList = $parkingService->parkingList();

        $timeEnd = microtime(true);
        $timeExecute = $timeEnd - $timeStart;

        $this->assertTrue($timeExecute < 1, $timeExecute);

        foreach ($parkingList as $parking) {
            $this->assertTrue($parking->canParking());
        }

    }
}
