<?php


namespace Infrastructure;


use Domain\Model\Entity\ParkingSpace;
use Domain\Model\ValueObject\ParkingId;
use Domain\Model\ValueObject\ParkingSpaceId;

class ParkingSpaceRepository
{
    public function findParkingSpace(ParkingId $parkingId)
    {
        // データベースから駐車スペースの情報を取得してエンティティにして返す

        return [new ParkingSpace(new ParkingSpaceId(uniqid()), $parkingId)];
    }
}