<?php

namespace AppBundle\Tests\Entity;

use AppBundle\Entity\Attendee;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Validation;

class AttendeeTest extends TestCase
{
  private $validator;

  public function __construct() {
    $this->validator = Validation::createValidatorBuilder()->enableAnnotationMapping()->getValidator();
  }

  public function testName() {
    $attendee = new Attendee();

    $this->assertNull($attendee->getFirstName());
    $this->assertNull($attendee->getMiddleInitial());
    $this->assertNull($attendee->getLastName());

    $attendee->setFirstName("John");
    $this->assertEquals("John", $attendee->getFirstName());

    $attendee->setMiddleInitial("h");
    $this->assertEquals("h", $attendee->getMiddleInitial());
    $this->assertEquals(1, count($this->validator->validate($attendee)));

    $attendee->setMiddleInitial("H.");
    $this->assertEquals(0, count($this->validator->validate($attendee)));

    $attendee->setLastName("Doe");
    $this->assertEquals("Doe", $attendee->getLastName());

    $this->assertEquals("John H. Doe", $attendee->getFullName());
  }

  public function testEmail() {
    $attendee = new Attendee();

    $this->assertNull($attendee->getEmail());

    $attendee->setEmail("john.doe@example.com");
    $this->assertEquals("john.doe@example.com", $attendee->getEmail());
    $this->assertEquals(0, count($this->validator->validate($attendee)));

    $attendee->setEmail("NotAnEmail");
    $this->assertEquals(1, count($this->validator->validate($attendee)));
  }

  public function testPhoneNumber() {
    $attendee = new Attendee();

    $this->assertNull($attendee->getPhoneNumber());

    $attendee->setPhoneNumber("555-555-5555");
    $this->assertEquals("555-555-5555", $attendee->getPhoneNumber());
    $this->assertEquals(0, count($this->validator->validate($attendee)));

    $attendee->setPhoneNumber("5555555555");
    $this->assertEquals(1, count($this->validator->validate($attendee)));
  }
}
