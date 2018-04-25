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
    $this->assertEquals("H.", $attendee->getMiddleInitial());

    $attendee->setLastName("Doe");
    $this->assertEquals("Doe", $attendee->getLastName());

    $this->assertEquals("John H. Doe", $attendee->getFullName());
  }

  public function testEmail() {
    $attendee = new Attendee();

    $this->assertNull($attendee->getEmail());

    $attendee->setEmail("john.doe@example.com");
    $this->assertEquals("john.doe@example.com", $attendee->getEmail());

    // TODO: test constraints by giving an improper email
  }

  public function testPhoneNumber() {
    $attendee = new Attendee();

    $this->assertNull($attendee->getPhoneNumber());

    $attendee->setPhoneNumber("555-555-5555");
    $this->assertEquals("555-555-5555", $attendee->getPhoneNumber());

    // TODO: test constraints by giving an improper phone number
  }
}
