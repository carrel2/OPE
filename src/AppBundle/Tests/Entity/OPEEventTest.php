<?php

namespace AppBundle\Tests\Entity;

use AppBundle\Entity\OPEEvent;
use AppBundle\Entity\Attendee;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Validation;

class OPEEventTest extends TestCase
{
  private $validator;

  public function __construct() {
    $this->validator = Validation::createValidatorBuilder()->enableAnnotationMapping()->getValidator();
  }

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

    $dates = [date("Y-m-d"), date("Y-m-d", strtotime("+1 week"))];

    $opeEvent->setDates($dates);
    $this->assertEquals(0, count($this->validator->validate($opeEvent)));
    $this->assertEquals($dates, $opeEvent->getDates());

    $currentTime = time();

    $opeEvent->addDate($currentTime);
    $this->assertContains($currentTime, $opeEvent->getDates());
    $this->assertGreaterThan(0, count($this->validator->validate($opeEvent)));

    $opeEvent->removeDate($currentTime);
    $this->assertNotContains($currentTime, $opeEvent->getDates());
    $this->assertEquals(0, count($this->validator->validate($opeEvent)));
  }

  public function testAttendees() {
    $attendee = new Attendee();
    $opeEvent = new OPEEvent();

    $this->assertNotFalse($opeEvent->addAttendee($attendee));
    $this->assertFalse($opeEvent->addAttendee($attendee));
    $this->assertTrue($opeEvent->getAttendees()->contains($attendee));
    $this->assertTrue($attendee->getOPEEvents()->contains($opeEvent));

    $this->assertTrue($opeEvent->removeAttendee($attendee));
    $this->assertFalse($opeEvent->getAttendees()->contains($attendee));
    $this->assertFalse($attendee->getOPEEvents()->contains($opeEvent));
  }
}
