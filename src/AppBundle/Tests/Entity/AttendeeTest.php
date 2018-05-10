<?php

namespace AppBundle\Tests\Entity;

use AppBundle\Entity\Attendee;
use PHPUnit\Framework\TestCase;

class AttendeeTest extends TestCase
{
  public function testName() {
    $attendee = new Attendee();

    $this->assertNull($attendee->getFirstName());
    $this->assertNull($attendee->getMiddleInitial());
    $this->assertNull($attendee->getLastName());

    $attendee->setFirstName("John");
    $this->assertEquals("John", $attendee->getFirstName());

    $attendee->setMiddleInitial("H.");

    $attendee->setLastName("Doe");
    $this->assertEquals("Doe", $attendee->getLastName());

    $this->assertEquals("John H. Doe", $attendee->getFullName());
  }

  public function testEmail() {
    $attendee = new Attendee();

    $this->assertNull($attendee->getEmail());

    $attendee->setEmail("john.doe@example.com");
    $this->assertEquals("john.doe@example.com", $attendee->getEmail());
  }

  public function testPhoneNumber() {
    $attendee = new Attendee();

    $this->assertNull($attendee->getPhoneNumber());

    $attendee->setPhoneNumber("555-555-5555");
    $this->assertEquals("555-555-5555", $attendee->getPhoneNumber());
  }

  public function testOPEEvents() {
    $attendee = new Attendee();
    $opeEvent = new \AppBundle\Entity\OPEEvent();

    $this->assertInstanceOf('\Doctrine\Common\Collections\ArrayCollection', $attendee->getOPEEvents());
    $this->assertTrue($attendee->getOPEEvents()->isEmpty());

    $this->assertNotFalse($attendee->addOPEEvent($opeEvent));
    $this->assertFalse($attendee->addOPEEvent($opeEvent));
    $this->assertTrue($attendee->getOPEEvents()->contains($opeEvent));
    $this->assertTrue($opeEvent->getAttendees()->contains($attendee));

    $this->assertTrue($attendee->removeOPEEvent($opeEvent));
    $this->assertFalse($attendee->getOPEEvents()->contains($opeEvent));
    $this->assertFalse($opeEvent->getAttendees()->contains($attendee));
  }
}
