<?php


namespace App\Models;

use DateTimeInterface;

trait Timestamp
{

    protected function serializeDate(?DateTimeInterface $dateTime): float|int|null
    {
        if ($dateTime == null)
            return null;
        return $dateTime->getTimestamp() * 1000;
    }

}
