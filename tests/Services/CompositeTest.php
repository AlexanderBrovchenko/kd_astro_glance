<?php

namespace App\Tests\Services;

use App\Controller\Composite;
use PHPUnit\Framework\TestCase;

class CompositeTest extends TestCase
{
    public function testLeft()
    {
        $result = Composite::left("Jordan", 2);
        $this->assertEquals("Jo", $result);
    }

    public function testMid()
    {
        $result = Composite::mid("Jordan", 2, 4);
        $this->assertEquals("orda", $result);
    }

    public function testCrunch()
    {
        $result1 = Composite::Crunch(1450);
        $result2 = Composite::Crunch(-5690);
        $this->assertEquals(10, $result1);
        $this->assertEquals(70, $result2);
    }

    public function testReduce_below_30()
    {
        $result1 = Composite::Reduce_below_30(24.5);
        $result2 = Composite::Reduce_below_30(119.75);
        $this->assertEquals(24.5, $result1);
        $this->assertEquals(29.75, $result2);
    }

    public function testConvert_Longitude_no_secs()
    {
        $result1 = Composite::Convert_Longitude_no_secs(24.5);
        $result2 = Composite::Convert_Longitude_no_secs(119.75);
        $this->assertEquals("24 Ari 30", $result1);
        $this->assertEquals("29 Can 45", $result2);
    }

    public function testConvert_Longitude()
    {
        $result1 = Composite::Convert_Longitude(24.33);
        $result2 = Composite::Convert_Longitude(119.07);
        $this->assertEquals("24 Ari 19' 48" . chr(34), $result1);
        $this->assertEquals("29 Can 04' 12" . chr(34), $result2);
    }

    public function testGetJulianDate()
    {
        $result1 = Composite::GetJulianDate(19, 57, 0, 5, 5, 1971);
        $result2 = Composite::GetJulianDate(0, 0, 0, 11, 19, 2020);
        $result3 = Composite::GetJulianDate(0, 0, 0, 5, 5, 1071);
        $this->assertEquals(2441077.33125, $result1);
        $this->assertEquals(2459172.5, $result2);
        $this->assertEquals(2112364.5, $result3);
    }
}