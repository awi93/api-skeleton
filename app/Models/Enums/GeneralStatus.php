<?php


namespace App\Models\Enums;


class GeneralStatus
{

    CONST DRAFTED = 100;
    CONST ACTIVATED = 200;
    CONST DEACTIVATED = 300;
    CONST ARCHIVED = 400;
    CONST DELETED = 500;

    static public function in () : string {
        return sprintf("%d,%d,%d,%d,%d", self::DRAFTED, self::ACTIVATED, self::DEACTIVATED, self::ARCHIVED, self::DELETED);
    }

}
