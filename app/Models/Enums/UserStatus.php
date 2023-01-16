<?php

namespace App\Models\Enums;

class UserStatus
{
    CONST CREATED = 100;
    CONST ACTIVATED = 200;
    CONST DEACTIVATED = 300;
    CONST BLOCKED = 400;

    static function in () {
        return sprintf("%d,%d,%d,%d", self::CREATED, self::ACTIVATED, self::DEACTIVATED, self::BLOCKED);
    }
}
