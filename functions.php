<?php

function FormatResult($Days, $format)
{
    switch ($format)
    {
    case 1: return $Days * 24 * 60 * 60; // Seconds
    case 2: return $Days * 24 * 60; // Minutes
    case 3: return $Days * 24; // Hours
    case 4: return $Days; // Days
    case 5: return floor($Days / 365); // Years
    }
}

function ValidateDate($date, $format = 'Y-m-d H:i:s')
{
    $d = DateTime::createFromFormat($format, $date);
    $valid = DateTime::getLastErrors();
    if ($valid['warning_count']!=0 || $valid['error_count']!=0)
    {
        return false;
    }
    return $d && $d->format($format) == $date;
}

function DaysBetween($Start, $End, $ResultFormat = 4, $Dateformat = 'Y-m-d H:i:s')
{
    if (!ValidateDate($Start, $Dateformat)) { return false; }
    if (!ValidateDate($End, $Dateformat)) { return false; }

    $StartDate = DateTime::createFromFormat($Dateformat,$Start);
    $EndDate = DateTime::createFromFormat($Dateformat,$End);
    if ($StartDate > $EndDate)
    {
        return 0;
    }
    $diff = $EndDate->diff($StartDate);
    return FormatResult($diff->days, $ResultFormat);
}

function WeeksBetween($Start, $End, $ResultFormat = 4, $Dateformat = 'Y-m-d H:i:s')
{
    $Days = DaysBetween($Start, $End, 4, $Dateformat);
    if ($Days === false)
    {
        return false;
    }
    return FormatResult(floor($Days / 7), $ResultFormat);
}

function WeekdaysBetween($Start, $End, $ResultFormat = 4, $Dateformat = 'Y-m-d H:i:s')
{
    $Days = DaysBetween($Start, $End, 4, $Dateformat);
    if ($Days === false)
    {
        return false;
    }

    $StartDate = DateTime::createFromFormat($Dateformat,$Start);
    $EndDate = DateTime::createFromFormat($Dateformat,$End);
    if ($StartDate > $EndDate)
    {
        return 0;
    }

    $Days = 0;
    $end = intval($EndDate->format('U'));
    for ($Day = intval($StartDate->format('U')); $Day <= $end; $Day += 86400)
    {
        if (date("N", $Day) <= 5)
        {
            $Days += 1;
        };
    }
    return FormatResult($Days,$ResultFormat);
}
