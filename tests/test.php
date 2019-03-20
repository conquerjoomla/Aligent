<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;

require_once(dirname(dirname(__FILE__)).'/functions.php');

final class AligentTest extends TestCase
{
    public function testFormatResult(): void
    {
        $this->assertEquals(FormatResult(1,1),86400);
        $this->assertEquals(FormatResult(1,2),1440);
        $this->assertEquals(FormatResult(1,3),24);
        $this->assertEquals(FormatResult(1,4),1);
        $this->assertEquals(FormatResult(1,5),0);
        $this->assertEquals(FormatResult(400,1),34560000);
        $this->assertEquals(FormatResult(400,2),576000);
        $this->assertEquals(FormatResult(400,3),9600);
        $this->assertEquals(FormatResult(400,4),400);
        $this->assertEquals(FormatResult(400,5),1);
    }

    public function testValidDate(): void
    {
        $this->assertTrue(validateDate('2019-02-28','Y-m-d'));
        $this->assertFalse(validateDate('2019-02-30','Y-m-d'));
        $this->assertFalse(validateDate('aaaa','Y-m-d'));
        $this->assertFalse(validateDate(null,'Y-m-d'));
        $this->assertFalse(validateDate('2019-01-01 12:00:00','Y-m-d'));
        $this->assertTrue(validateDate('2019-01-01 12:00:00','Y-m-d H:i:s'));
        $this->assertTrue(validateDate('2019-01-01','Y-m-d'));
        $this->assertFalse(validateDate('2019-01-1','Y-m-d'));
        $this->assertTrue(validateDate('2019-01-1','Y-m-j'));
        $this->assertFalse(validateDate('2019-1-1','Y-m-j'));
        $this->assertTrue(validateDate('2019-1-1','Y-n-j'));
    }

    public function testDaysBetween(): void
    {
        $this->assertEquals(DaysBetween('2019-6-24', '2019-6-26', 4, 'Y-n-j'),2);
        $this->assertEquals(DaysBetween('2019-3-1', '2019-7-1', 4, 'Y-n-j'),122);
        $this->assertEquals(DaysBetween('2019-6-26', '2019-6-24', 4, 'Y-n-j'),0);
        $this->assertEquals(DaysBetween('2019-2-24', '2019-3-1', 4, 'Y-n-j'),5);
        $this->assertEquals(DaysBetween('2020-2-24', '2020-3-1', 4, 'Y-n-j'),6);
        $this->assertEquals(DaysBetween('2019-1-1', '2020-1-1', 4, 'Y-n-j'),365);
        $this->assertEquals(DaysBetween('2016-1-1', '2017-1-1', 4, 'Y-n-j'),366);
        $this->assertEquals(DaysBetween('2000-1-1', '2001-1-1', 4, 'Y-n-j'),366);
        $this->assertEquals(DaysBetween('2100-1-1', '2101-1-1', 4, 'Y-n-j'),365);
    }

    public function testWeekdaysBetween(): void
    {
        $this->assertEquals(WeekdaysBetween('2019-3-1 12:00:00', '2019-3-1 12:00:00', 4, 'Y-n-j H:i:s'),1);
        $this->assertEquals(WeekdaysBetween('2019-3-1 12:00:00', '2019-3-2 12:00:00', 4, 'Y-n-j H:i:s'),1);
        $this->assertEquals(WeekdaysBetween('2019-3-1 12:00:00', '2019-3-3 12:00:00', 4, 'Y-n-j H:i:s'),1);
        $this->assertEquals(WeekdaysBetween('2019-3-1 12:00:00', '2019-3-4 12:00:00', 4, 'Y-n-j H:i:s'),2);
        $this->assertEquals(WeekdaysBetween('2019-3-1 12:00:00', '2019-3-5 12:00:00', 4, 'Y-n-j H:i:s'),3);
        $this->assertEquals(WeekdaysBetween('2019-3-1 12:00:00', '2019-3-6 12:00:00', 4, 'Y-n-j H:i:s'),4);
        $this->assertEquals(WeekdaysBetween('2019-3-1 12:00:00', '2019-3-7 12:00:00', 4, 'Y-n-j H:i:s'),5);
        $this->assertEquals(WeekdaysBetween('2019-3-1 12:00:00', '2019-3-8 12:00:00', 4, 'Y-n-j H:i:s'),6);
        $this->assertEquals(WeekdaysBetween('2019-3-1 12:00:00', '2019-3-9 12:00:00', 4, 'Y-n-j H:i:s'),6);
        $this->assertEquals(WeekdaysBetween('2019-3-1 12:00:00', '2019-3-10 12:00:00', 4, 'Y-n-j H:i:s'),6);
        $this->assertEquals(WeekdaysBetween('2019-3-1 12:00:00', '2019-3-11 12:00:00', 4, 'Y-n-j H:i:s'),7);
        $this->assertEquals(WeekdaysBetween('2019-3-1 12:00:00', '2019-3-12 12:00:00', 4, 'Y-n-j H:i:s'),8);
        $this->assertEquals(WeekdaysBetween('2019-3-1 12:00:00', '2019-3-13 12:00:00', 4, 'Y-n-j H:i:s'),9);
        $this->assertEquals(WeekdaysBetween('2019-3-1 12:00:00', '2019-3-14 12:00:00', 4, 'Y-n-j H:i:s'),10);
        $this->assertEquals(WeekdaysBetween('2019-3-1 12:00:00', '2019-3-15 12:00:00', 4, 'Y-n-j H:i:s'),11);
        $this->assertEquals(WeekdaysBetween('2019-3-1 12:00:00', '2019-3-16 12:00:00', 4, 'Y-n-j H:i:s'),11);
        $this->assertEquals(WeekdaysBetween('2019-3-1 12:00:00', '2019-3-17 12:00:00', 4, 'Y-n-j H:i:s'),11);
        $this->assertEquals(WeekdaysBetween('2019-3-1 12:00:00', '2019-3-18 12:00:00', 4, 'Y-n-j H:i:s'),12);

        $this->assertEquals(WeekdaysBetween('2019-3-2 12:00:00', '2019-3-2 12:00:00', 4, 'Y-n-j H:i:s'),0);
        $this->assertEquals(WeekdaysBetween('2019-3-2 12:00:00', '2019-3-3 12:00:00', 4, 'Y-n-j H:i:s'),0);
        $this->assertEquals(WeekdaysBetween('2019-3-2 12:00:00', '2019-3-4 12:00:00', 4, 'Y-n-j H:i:s'),1);
        $this->assertEquals(WeekdaysBetween('2019-3-2 12:00:00', '2019-3-5 12:00:00', 4, 'Y-n-j H:i:s'),2);
        $this->assertEquals(WeekdaysBetween('2019-3-2 12:00:00', '2019-3-6 12:00:00', 4, 'Y-n-j H:i:s'),3);
        $this->assertEquals(WeekdaysBetween('2019-3-2 12:00:00', '2019-3-7 12:00:00', 4, 'Y-n-j H:i:s'),4);
        $this->assertEquals(WeekdaysBetween('2019-3-2 12:00:00', '2019-3-8 12:00:00', 4, 'Y-n-j H:i:s'),5);
        $this->assertEquals(WeekdaysBetween('2019-3-2 12:00:00', '2019-3-9 12:00:00', 4, 'Y-n-j H:i:s'),5);
        $this->assertEquals(WeekdaysBetween('2019-3-2 12:00:00', '2019-3-10 12:00:00', 4, 'Y-n-j H:i:s'),5);
        $this->assertEquals(WeekdaysBetween('2019-3-2 12:00:00', '2019-3-11 12:00:00', 4, 'Y-n-j H:i:s'),6);
        $this->assertEquals(WeekdaysBetween('2019-3-2 12:00:00', '2019-3-12 12:00:00', 4, 'Y-n-j H:i:s'),7);
        $this->assertEquals(WeekdaysBetween('2019-3-2 12:00:00', '2019-3-13 12:00:00', 4, 'Y-n-j H:i:s'),8);
        $this->assertEquals(WeekdaysBetween('2019-3-2 12:00:00', '2019-3-14 12:00:00', 4, 'Y-n-j H:i:s'),9);
        $this->assertEquals(WeekdaysBetween('2019-3-2 12:00:00', '2019-3-15 12:00:00', 4, 'Y-n-j H:i:s'),10);
        $this->assertEquals(WeekdaysBetween('2019-3-2 12:00:00', '2019-3-16 12:00:00', 4, 'Y-n-j H:i:s'),10);
        $this->assertEquals(WeekdaysBetween('2019-3-2 12:00:00', '2019-3-17 12:00:00', 4, 'Y-n-j H:i:s'),10);
        $this->assertEquals(WeekdaysBetween('2019-3-2 12:00:00', '2019-3-18 12:00:00', 4, 'Y-n-j H:i:s'),11);
        $this->assertEquals(WeekdaysBetween('2019-3-2 12:00:00', '2019-3-19 12:00:00', 4, 'Y-n-j H:i:s'),12);

        $this->assertEquals(WeekdaysBetween('2019-3-6 12:00:00', '2019-3-6 12:00:00', 4, 'Y-n-j H:i:s'),1);
        $this->assertEquals(WeekdaysBetween('2019-3-6 12:00:00', '2019-3-7 12:00:00', 4, 'Y-n-j H:i:s'),2);
        $this->assertEquals(WeekdaysBetween('2019-3-6 12:00:00', '2019-3-8 12:00:00', 4, 'Y-n-j H:i:s'),3);
        $this->assertEquals(WeekdaysBetween('2019-3-6 12:00:00', '2019-3-9 12:00:00', 4, 'Y-n-j H:i:s'),3);
        $this->assertEquals(WeekdaysBetween('2019-3-6 12:00:00', '2019-3-10 12:00:00', 4, 'Y-n-j H:i:s'),3);
        $this->assertEquals(WeekdaysBetween('2019-3-6 12:00:00', '2019-3-11 12:00:00', 4, 'Y-n-j H:i:s'),4);
        $this->assertEquals(WeekdaysBetween('2019-3-6 12:00:00', '2019-3-12 12:00:00', 4, 'Y-n-j H:i:s'),5);
        $this->assertEquals(WeekdaysBetween('2019-3-6 12:00:00', '2019-3-13 12:00:00', 4, 'Y-n-j H:i:s'),6);
        $this->assertEquals(WeekdaysBetween('2019-3-6 12:00:00', '2019-3-14 12:00:00', 4, 'Y-n-j H:i:s'),7);
        $this->assertEquals(WeekdaysBetween('2019-3-6 12:00:00', '2019-3-15 12:00:00', 4, 'Y-n-j H:i:s'),8);
        $this->assertEquals(WeekdaysBetween('2019-3-6 12:00:00', '2019-3-16 12:00:00', 4, 'Y-n-j H:i:s'),8);
        $this->assertEquals(WeekdaysBetween('2019-3-6 12:00:00', '2019-3-17 12:00:00', 4, 'Y-n-j H:i:s'),8);
        $this->assertEquals(WeekdaysBetween('2019-3-6 12:00:00', '2019-3-18 12:00:00', 4, 'Y-n-j H:i:s'),9);
        $this->assertEquals(WeekdaysBetween('2019-3-6 12:00:00', '2019-3-19 12:00:00', 4, 'Y-n-j H:i:s'),10);
        $this->assertEquals(WeekdaysBetween('2019-3-6 12:00:00', '2019-3-20 12:00:00', 4, 'Y-n-j H:i:s'),11);
        $this->assertEquals(WeekdaysBetween('2019-3-6 12:00:00', '2019-3-21 12:00:00', 4, 'Y-n-j H:i:s'),12);
        $this->assertEquals(WeekdaysBetween('2019-3-6 12:00:00', '2019-3-22 12:00:00', 4, 'Y-n-j H:i:s'),13);
    }

    public function testWeeksBetween(): void
    {
        $this->assertEquals(WeeksBetween('2019-3-1', '2019-3-5', 4, 'Y-n-j'),0);
        $this->assertEquals(WeeksBetween('2019-3-1', '2019-3-8', 4, 'Y-n-j'),1);
        $this->assertEquals(WeeksBetween('2019-1-1', '2019-12-31', 4, 'Y-n-j'),52);
    }
}
