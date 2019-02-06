<?php


namespace Infrastructure;


use Domain\Model\Entity\ParkingSpace;
use Domain\Model\ValueObject\ParkingId;

class ParkingSpaceRepository implements \Domain\Repository\ParkingSpace
{

    public function parkingSpaceMemory(array $parkingIds)
    {
        // ParkingSpacesMemoryに駐車場IDがキーで駐車スペースが値の配列を
        // 渡してあげる
        return new ParkingSpacesMemory([]);
    }

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