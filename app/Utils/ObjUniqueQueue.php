<?php

namespace App\Utils;

class ObjUniqueQueue implements Queue
{
    private array $datos;

    public function __construct()
    {
        $this->datos = [];
    }

    public function add(Obj $obj, $closure): int
    {
        for ($i = 0; $i < count($this->datos); $i++) {
            if ($this->datos[$i]->getId() == $obj->getId()) {
                $this->datos[$i] = $closure($this->datos[$i]);
                return 1;
            }
        }
        return array_push($this->datos, $obj);
    }

    public function getDataAsArray()
    {
        $newData = [];
        foreach ($this->datos as $d)
            array_push($newData, $d->toArray());
        return $newData;
    }
}
