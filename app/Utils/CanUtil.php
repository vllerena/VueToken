<?php

namespace App\Utils;

class CanUtil
{
    static function can(string $accion, $param)
    {
        return 'can:' . $accion . "," . $param;
    }
}
