<?php


use Carbon\Carbon;

function diffHour($start, $end, $format)
{
    $startDate = createFromFormat($start, $format);
    $endDate = createFromFormat($end, $format);
    return $startDate->floatDiffInHours($endDate, false);
}

function createFromFormat($date, $format, $val = "")
{
    try {
        $converted = Carbon::createFromFormat($format, $date);
        if ($converted)
            return $converted;
        return $val == "null" ? null : now();
    } catch (Exception $e) {
        return $val == "null" ? null : now();
    }
}

