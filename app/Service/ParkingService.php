<?php


namespace App\Service;


use Domain\Model\Entity\Parking;
use Domain\Service\ParkingState;
use Infrastructure\ParkingRepository;
use Infrastructure\ParkingSpaceRepository;

class ParkingService
{

    private $parkingRepository;
    private $parkingSpaceRepository;

    public function __construct(ParkingRepository $parkingRepository, ParkingSpaceRepository $parkingSpaceRepository)
    {
        $this->parkingRepository = $parkingRepository;
        $this->parkingSpaceRepository = $parkingSpaceRepository;
    }

    /**
     * 駐車場一覧ページで表示する駐車場エンティティを設定する
     *
     * @return Parking[]
     */
    public function parkingList()
    {
        /** @var Parking[] $parkings */
        $parkings = $this->parkingRepository->all();

        foreach ($parkings as $parking) {
            $parkingAvailable = ParkingState::parkingAvailable($parking, $this->parkingSpaceRepository);
            $parking->setParkingAvailable($parkingAvailable);
        }

        return $parkings;
    }
}