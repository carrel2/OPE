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

  public function testCEHours() {
    $opeEvent = new OPEEvent();

    $this->assertNull($opeEvent->getCEHours());

    $opeEvent->setCEHours(2.1);
    $this->assertEquals(2.1, $opeEvent->getCEHours());
  }

  public function testDates() {
    $opeEvent = new OPEEvent();

    $dates = $opeEvent->getDates();

    $this->assertInternalType('array', $dates);
    $this->assertEmpty($dates);

    $dates = [date("Y-m-d", strtotime("+1 day")), date("Y-m-d", strtotime("+1 week"))];

    $opeEvent->setDates($dates);
    $this->assertEquals($dates, $opeEvent->getDates());

    $currentDate = date("Y-m-d");

    $opeEvent->addDate($currentDate);
    $this->assertContains($currentDate, $opeEvent->getDates());

    $opeEvent->removeDate($currentDate);
    $this->assertNotContains($currentDate, $opeEvent->getDates());
  }

  public function testAttendees() {
    $attendee = new \AppBundle\Entity\Attendee();
    $opeEvent = new OPEEvent();

    $this->assertInstanceOf('\Doctrine\Common\Collections\ArrayCollection', $opeEvent->getAttendees());
    $this->assertTrue($opeEvent->getAttendees()->isEmpty());

    $this->assertNotFalse($opeEvent->addAttendee($attendee));
    $this->assertFalse($opeEvent->addAttendee($attendee));
    $this->assertTrue($opeEvent->getAttendees()->contains($attendee));
    $this->assertTrue($attendee->getOPEEvents()->contains($opeEvent));

    $this->assertTrue($opeEvent->removeAttendee($attendee));
    $this->assertFalse($opeEvent->getAttendees()->contains($attendee));
    $this->assertFalse($attendee->getOPEEvents()->contains($opeEvent));
  }
}
