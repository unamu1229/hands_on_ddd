<?php


namespace Infrastructure;


use Domain\Model\Entity\ParkingSpace;
use Domain\Model\ValueObject\ParkingId;

class ParkingSpaceRepository
{

    /**
     * @param ParkingId $parkingId
     * @return ParkingSpace[]
     */
    public function findParkingSpace(ParkingId $parkingId)
    {
        // データベースから駐車スペースの情報を取得してエンティティにして返す
        return [];
    }
}