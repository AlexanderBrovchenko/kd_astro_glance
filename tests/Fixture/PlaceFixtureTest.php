<?php

namespace App\Tests\Fixtures;

use App\DataFixtures\PlaceFixture;
use PHPUnit\Framework\TestCase;

class PlaceFixtureTest extends TestCase
{
    public function testturnToString()
    {
        $pf = new PlaceFixture();
        $result1 = $pf->turnToString("EW", "72.8333");
        $result2 = $pf->turnToString("NS", "-23.5504");
        $result3 = $pf->turnToString("EW", "-99.2342");
        $result4 = $pf->turnToString("NS", "18.9176");
        $result5 = $pf->turnToString("EW", "-0.0000");
        $this->assertEquals("E072.50.00", $result1);
        $this->assertEquals("S23.33.01", $result2);
        $this->assertEquals("W099.14.03", $result3);
        $this->assertEquals("N18.55.03", $result4);
        $this->assertEquals("W000.00.00", $result5);
    }
}