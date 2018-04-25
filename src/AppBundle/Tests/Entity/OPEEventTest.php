<?php

namespace AppBundle\Tests\Entity;

use AppBundle\Entity\OPEEvent;
use PHPUnit\Framework\TestCase;

class OPEEventTest extends TestCase
{
  public function testTitle() {
    $opeEvent = new OPEEvent();

    $this->assertNull($opeEvent->getTitle());

    $opeEvent->setTitle("OPE Event");
    $this->assertEquals("OPE Event", $opeEvent->getTitle());
  }

  public function testDates() {
    $opeEvent = new OPEEvent();

    $dates = $opeEvent->getDates();

    $this->assertInternalType('array', $dates);
    $this->assertEmpty($dates);

    $dates = [microtime(), time(), localtime()];

    $opeEvent->setDates($dates);
    $this->assertEquals($dates, $opeEvent->getDates());

    $opeEvent->addDate("Today");
    $this->assertContains("Today", $opeEvent->getDates());

    $opeEvent->removeDate("Today");
    $this->assertNotContains("Today", $opeEvent->getDates());
  }
}
