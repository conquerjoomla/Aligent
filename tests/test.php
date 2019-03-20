<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;

require_once(dirname(dirname(__FILE__)).'/functions.php');

final class AligentTest extends TestCase
{
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
		$this->assertEquals(DaysBetween('2019-6-24', '2019-6-26', 'Y-n-j'),2);
		$this->assertEquals(DaysBetween('2019-3-1', '2019-7-1', 'Y-n-j'),122);
		$this->assertEquals(DaysBetween('2019-6-26', '2019-6-24', 'Y-n-j'),0);
		$this->assertEquals(DaysBetween('2019-2-24', '2019-3-1', 'Y-n-j'),5);
		$this->assertEquals(DaysBetween('2020-2-24', '2020-3-1', 'Y-n-j'),6);
		$this->assertEquals(DaysBetween('2019-1-1', '2020-1-1', 'Y-n-j'),365);
		$this->assertEquals(DaysBetween('2016-1-1', '2017-1-1', 'Y-n-j'),366);
		$this->assertEquals(DaysBetween('2000-1-1', '2001-1-1', 'Y-n-j'),366);
		$this->assertEquals(DaysBetween('2100-1-1', '2101-1-1', 'Y-n-j'),365);
    }
	
	public function testWeekdaysBetween(): void
	{
		$this->assertEquals(WeekdaysBetween('2019-3-1', '2019-3-1', 'Y-n-j'),1);
		$this->assertEquals(WeekdaysBetween('2019-3-1', '2019-3-2', 'Y-n-j'),1);
		$this->assertEquals(WeekdaysBetween('2019-3-1', '2019-3-3', 'Y-n-j'),1);
		$this->assertEquals(WeekdaysBetween('2019-3-1', '2019-3-4', 'Y-n-j'),2);
		$this->assertEquals(WeekdaysBetween('2019-3-1', '2019-3-5', 'Y-n-j'),3);
		$this->assertEquals(WeekdaysBetween('2019-3-1', '2019-3-6', 'Y-n-j'),4);
		$this->assertEquals(WeekdaysBetween('2019-3-1', '2019-3-7', 'Y-n-j'),5);
		$this->assertEquals(WeekdaysBetween('2019-3-1', '2019-3-8', 'Y-n-j'),6);
		$this->assertEquals(WeekdaysBetween('2019-3-1', '2019-3-9', 'Y-n-j'),6);
		$this->assertEquals(WeekdaysBetween('2019-3-1', '2019-3-10', 'Y-n-j'),6);
		$this->assertEquals(WeekdaysBetween('2019-3-1', '2019-3-11', 'Y-n-j'),7);
		$this->assertEquals(WeekdaysBetween('2019-3-1', '2019-3-12', 'Y-n-j'),8);
		$this->assertEquals(WeekdaysBetween('2019-3-1', '2019-3-13', 'Y-n-j'),9);
		$this->assertEquals(WeekdaysBetween('2019-3-1', '2019-3-14', 'Y-n-j'),10);
		$this->assertEquals(WeekdaysBetween('2019-3-1', '2019-3-15', 'Y-n-j'),11);
		$this->assertEquals(WeekdaysBetween('2019-3-1', '2019-3-16', 'Y-n-j'),11);
		$this->assertEquals(WeekdaysBetween('2019-3-1', '2019-3-17', 'Y-n-j'),11);
		$this->assertEquals(WeekdaysBetween('2019-3-1', '2019-3-18', 'Y-n-j'),12);

		$this->assertEquals(WeekdaysBetween('2019-3-2', '2019-3-2', 'Y-n-j'),0);
		$this->assertEquals(WeekdaysBetween('2019-3-2', '2019-3-3', 'Y-n-j'),0);
		$this->assertEquals(WeekdaysBetween('2019-3-2', '2019-3-4', 'Y-n-j'),1);
		$this->assertEquals(WeekdaysBetween('2019-3-2', '2019-3-5', 'Y-n-j'),2);
		$this->assertEquals(WeekdaysBetween('2019-3-2', '2019-3-6', 'Y-n-j'),3);
		$this->assertEquals(WeekdaysBetween('2019-3-2', '2019-3-7', 'Y-n-j'),4);
		$this->assertEquals(WeekdaysBetween('2019-3-2', '2019-3-8', 'Y-n-j'),5);
		$this->assertEquals(WeekdaysBetween('2019-3-2', '2019-3-9', 'Y-n-j'),5);
		$this->assertEquals(WeekdaysBetween('2019-3-2', '2019-3-10', 'Y-n-j'),5);
		$this->assertEquals(WeekdaysBetween('2019-3-2', '2019-3-11', 'Y-n-j'),6);
		$this->assertEquals(WeekdaysBetween('2019-3-2', '2019-3-12', 'Y-n-j'),7);
		$this->assertEquals(WeekdaysBetween('2019-3-2', '2019-3-13', 'Y-n-j'),8);
		$this->assertEquals(WeekdaysBetween('2019-3-2', '2019-3-14', 'Y-n-j'),9);
		$this->assertEquals(WeekdaysBetween('2019-3-2', '2019-3-15', 'Y-n-j'),10);
		$this->assertEquals(WeekdaysBetween('2019-3-2', '2019-3-16', 'Y-n-j'),10);
		$this->assertEquals(WeekdaysBetween('2019-3-2', '2019-3-17', 'Y-n-j'),10);
		$this->assertEquals(WeekdaysBetween('2019-3-2', '2019-3-18', 'Y-n-j'),11);
		$this->assertEquals(WeekdaysBetween('2019-3-2', '2019-3-19', 'Y-n-j'),12);

		$this->assertEquals(WeekdaysBetween('2019-3-6', '2019-3-6', 'Y-n-j'),1);
		$this->assertEquals(WeekdaysBetween('2019-3-6', '2019-3-7', 'Y-n-j'),2);
		$this->assertEquals(WeekdaysBetween('2019-3-6', '2019-3-8', 'Y-n-j'),3);
		$this->assertEquals(WeekdaysBetween('2019-3-6', '2019-3-9', 'Y-n-j'),3);
		$this->assertEquals(WeekdaysBetween('2019-3-6', '2019-3-10', 'Y-n-j'),3);
		$this->assertEquals(WeekdaysBetween('2019-3-6', '2019-3-11', 'Y-n-j'),4);
		$this->assertEquals(WeekdaysBetween('2019-3-6', '2019-3-12', 'Y-n-j'),5);
		$this->assertEquals(WeekdaysBetween('2019-3-6', '2019-3-13', 'Y-n-j'),6);
		$this->assertEquals(WeekdaysBetween('2019-3-6', '2019-3-14', 'Y-n-j'),7);
		$this->assertEquals(WeekdaysBetween('2019-3-6', '2019-3-15', 'Y-n-j'),8);
		$this->assertEquals(WeekdaysBetween('2019-3-6', '2019-3-16', 'Y-n-j'),8);
		$this->assertEquals(WeekdaysBetween('2019-3-6', '2019-3-17', 'Y-n-j'),8);
		$this->assertEquals(WeekdaysBetween('2019-3-6', '2019-3-18', 'Y-n-j'),9);
		$this->assertEquals(WeekdaysBetween('2019-3-6', '2019-3-19', 'Y-n-j'),10);
		$this->assertEquals(WeekdaysBetween('2019-3-6', '2019-3-20', 'Y-n-j'),11);
		$this->assertEquals(WeekdaysBetween('2019-3-6', '2019-3-21', 'Y-n-j'),12);
		$this->assertEquals(WeekdaysBetween('2019-3-6', '2019-3-22', 'Y-n-j'),13);
	}
	
    public function testWeeksBetween(): void
    {
		$this->assertEquals(WeeksBetween('2019-3-1', '2019-3-5', 'Y-n-j'),0);		
		$this->assertEquals(WeeksBetween('2019-3-1', '2019-3-8', 'Y-n-j'),1);		
		$this->assertEquals(WeeksBetween('2019-1-1', '2019-12-31', 'Y-n-j'),52);		
	}
}
