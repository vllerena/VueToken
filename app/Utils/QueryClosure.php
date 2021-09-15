<?php

namespace App\Utils;

trait QueryClosure
{

    public function whereRelated($related, $attr, $value)
    {
        return function ($query) use ($attr, $value, $related) {
            return $query->whereHas($related, function ($subQuery) use ($attr, $value) {
                return $subQuery->where($attr, $value);
            });
        };
    }

    public function whereEq($attr, $value)
    {
        return function ($query) use ($attr, $value) {
            return $query->where($attr, $value);
        };
    }

    public function whereDateOp($attr, $op, $value)
    {
        return function ($query) use ($op, $attr, $value) {
            return $query->whereDate($attr, $op, $value);
        };
    }

    public function whereTimeOp($attr, $op, $value)
    {
        return function ($query) use ($op, $attr, $value) {
            return $query->whereTime($attr, $op, $value);
        };
    }

    public function whereDateBetween($val, $attr1, $attr2)
    {
        return function ($query) use ($val, $attr1, $attr2) {
            return $query->whereRaw("'$val' BETWEEN $attr1 AND $attr2");
        };
    }

    public function whereAttrIn($attr, $value)
    {
        return function ($query) use ($attr, $value) {
            return $query->whereIn($attr, $value);
        };
    }
}
