<?php


namespace Domain\Model\ValueObject;

use Domain\Exception\DomainException;

class ParkingStatus
{
    const ACTIVE = 'active';
    const STOP = 'stop';

    private $status;

    public function __construct($status)
    {
        if (!in_array($status, $this->all())) {
            throw new DomainException('駐車スペースのステータスが不正です');
        }

        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    public function all()
    {
        return [self::ACTIVE, self::STOP];
    }
}