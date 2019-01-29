<?php

namespace Tests;


use Domain\Model\Entity\Parking;

class ParkingTest extends \PHPUnit\Framework\TestCase
{

    /**
     * 駐車場エンティティ作成のテスト
     */
    public function testGenerateParking()
    {
        $parking = new Parking();
        $this->assertTrue($parking instanceof Parking);
    }
}
