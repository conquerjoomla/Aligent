<?php

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

function DaysBetween($Start, $End, $format = 'Y-m-d H:i:s')
{
	if (!ValidateDate($Start, $format)) { return false; }
	if (!ValidateDate($End, $format)) { return false; }
	
	$StartDate = DateTime::createFromFormat($format,$Start);
	$EndDate = DateTime::createFromFormat($format,$End);
	if ($StartDate > $EndDate)
	{
		return 0;
	}
	$diff = $EndDate->diff($StartDate);
	return $diff->days;
}

function WeeksBetween($Start, $End, $format = 'Y-m-d H:i:s')
{
	$Days = DaysBetween($Start, $End, $format);
	if ($Days === false)
	{
		return false;
	} 
	return floor($Days / 7);
}

function WeekdaysBetween($Start, $End, $format = 'Y-m-d H:i:s')
{
	$Days = DaysBetween($Start, $End, $format);
	if ($Days === false)
	{
		return false;
	} 

	$StartDate = DateTime::createFromFormat($format,$Start);
	$EndDate = DateTime::createFromFormat($format,$End);
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
	return $Days;
}
