<?php


namespace Infrastructure;


use Domain\Model\ValueObject\ParkingId;
use Domain\Repository\ParkingSpace;


/**
 * プロパティに駐車スペースを取得しておいて、
 * データベースへのアクセス回数を減らす場合に利用する
 *
 * Class ParkingSpacesMemory
 * @package Infrastructure
 */
class ParkingSpacesMemory implements ParkingSpace
{
    private $parkingSpaces;
    
    public function __construct(array $parkingSpaces)
    {
        $this->parkingSpaces = $parkingSpaces;
    }

    public function findParkingSpace(ParkingId $parkingId)
    {
        if (array_key_exists($parkingId, $this->parkingSpaces)) {
            return $this->parkingSpaces[$parkingId->getId()];
        }

        return [];
    }
}