<?php


use Carbon\Carbon;

function generateFileName($name)
{
    $year = Carbon::now()->year;
    $month = Carbon::now()->month;
    $day = Carbon::now()->day;
    $hour = Carbon::now()->hour;
    $minute = Carbon::now()->minute;
    $second = Carbon::now()->second;
    $microsecond = Carbon::now()->microsecond;

    return $year . '_' . $month . '_' . $day . '_' . $hour . '_' . $minute . '_' . $second . '_' . $microsecond . '_' . $name;
}

function convertShamsiToGregorianDate($date){
    if($date == null){
        return null;
    }
    $pattern = "/[-\s]/";
    $shamsidateSplit = preg_split($pattern,$date);
    $arrayGregorianDate = verta()->jalaliToGregorian($shamsidateSplit[0], $shamsidateSplit[1], $shamsidateSplit[2]);
    return implode("-",$arrayGregorianDate)." ". $shamsidateSplit[3];
}

