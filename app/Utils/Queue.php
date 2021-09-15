<?php

namespace App\Utils;

interface Queue
{
    public function add(Obj $obj, $closure);

    public function getDataAsArray();
}
