<?php


namespace Infrastructure;


use Domain\Model\Entity\ParkingSpace;
use Domain\Model\ValueObject\ParkingId;

class ParkingSpaceRepository
{
    private $parkingSpaces;

    public function set(array $parkingIds)
    {
        // データベースから各駐車場の駐車スペースを取得し、
        // キーが$parkingId、値が駐車スペースの配列を保持する
        $this->parkingSpaces = [];
    }

    /**
     * @param ParkingId $parkingId
     * @return ParkingSpace[]
     */
    public function findParkingSpace(ParkingId $parkingId)
    {
        // ループ内で呼び出される時は、
        // 予めプロパティに駐車スペースを取得しておいて、
        // データベースへのアクセス回数を減らす
        if (array_key_exists($parkingId, $this->parkingSpaces)) {
            return $this->parkingSpaces[$parkingId->getId()];
        }
        // データベースから駐車スペースの情報を取得してエンティティにして返す
        return [];
    }
}