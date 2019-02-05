<?php


namespace Infrastructure;


use Domain\Model\Entity\Parking;
use Domain\Model\ValueObject\ParkingId;

class ParkingRepository
{
    public function all(){

        // データベースから駐車場を取得してエンティティとして返す
        return [new Parking(new ParkingId(uniqid()))];
    }
}