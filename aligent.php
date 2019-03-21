<?php

require_once(dirname(__FILE__).'/functions.php');

function DisplayUsage()
{
    echo "php.exe aligent.php Format DateTimeFormat StartDateTime EndDateTime StartTimezone EndTimezone\n";
    echo "\nFormat:\n";
    echo "1 - Seconds\n";
    echo "2 - Minutes\n";
    echo "3 - Hours\n";
    echo "4 - Days\n";
    echo "5 - Years\n";
    echo "\nDateTimeFormat: Uses php date format (eg: \"Y-n-j H:i:s\")\n";
}

if ($argc !=7)
{
    DisplayUsage();
    exit();
}

$ResultFormat = intval($argv[1]);
$DateTimeFormat = $argv[2];
$StartDateTime = $argv[3];
$EndDateTime = $argv[4];
$StartTimezone = $argv[5];
$EndTimezone = $argv[6];

if (!ValidateDate($StartDateTime, $DateTimeFormat, $StartTimezone))
{
    echo "Error: Start DateTime invalid\n";
    echo 'Start DateTime: '.$StartDateTime.' Timezone: "'.$StartTimezone."\"\n";
    echo 'DateTime Format: "'.$DateTimeFormat.'" Result Format: '.$ResultFormat."\n\n";
    exit();
}

if (!ValidateDate($EndDateTime, $DateTimeFormat, $EndTimezone))
{
    echo "Error: End DateTime invalid\n";
    echo 'End DateTime: '.$EndDateTime.' Timezone: "'.$EndTimezone."\"\n";
    echo 'DateTime Format: "'.$DateTimeFormat.'" Result Format: '.$ResultFormat."\n\n";
    exit();
}

echo 'Start DateTime: '.$StartDateTime.' Timezone: "'.$StartTimezone."\"\n";
echo 'End DateTime: '.$EndDateTime.' Timezone: "'.$EndTimezone."\"\n";
echo 'DateTime Format: "'.$DateTimeFormat.'" Result Format: '.$ResultFormat."\n\n";
echo ResultFormatName($ResultFormat).' between: '.DaysBetween($StartDateTime, $EndDateTime, $ResultFormat, $DateTimeFormat, $StartTimezone, $EndTimezone)."\n";
echo ResultFormatName($ResultFormat).' weekdays between: '.WeekdaysBetween($StartDateTime, $EndDateTime, $ResultFormat, $DateTimeFormat, $StartTimezone, $EndTimezone)."\n";
echo 'Complete Weeks between '.(WeeksBetween($StartDateTime, $EndDateTime, 4, $DateTimeFormat, $StartTimezone, $EndTimezone) / 7) .' (' . WeeksBetween($StartDateTime, $EndDateTime, $ResultFormat, $DateTimeFormat, $StartTimezone, $EndTimezone).' in '.ResultFormatName($ResultFormat).")\n";