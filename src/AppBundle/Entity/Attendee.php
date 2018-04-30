<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @Mapping\Entity
 * @Mapping\Table(name="attendee")
 */
class Attendee
{
  /**
   * @Mapping\Column(type="integer")
   * @Mapping\Id
   * @Mapping\GeneratedValue(strategy="AUTO")
   */
  private $id;

  /**
   * @Mapping\Column(type="string")
   */
  private $firstname;

  /**
   * @Mapping\Column(type="string", length=2)
   * @Assert\Regex("/[A-Z]\./")
   */
  private $middleinitial;

  /**
   * @Mapping\Column(type="string")
   */
  private $lastname;

  /**
   * @Mapping\Column(type="string")
   * @Assert\Email()
   */
  private $email;

  /**
   * @Mapping\Column(type="string")
   * @Assert\Regex("/^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]\d{3}[\s.-]\d{4}$/")
   */
  private $phonenumber;

  public function getId() {
    return $this->id;
  }

  public function setFirstName($fName) {
    $this->firstname = $fName;

    return $this;
  }

  public function getFirstName() {
    return $this->firstname;
  }

  public function setMiddleInitial($initial) {
    $this->middleinitial = $initial;

    return $this;
  }

  public function getMiddleInitial() {
    return $this->middleinitial;
  }

  public function setLastName($lName) {
    $this->lastname = $lName;

    return $this;
  }

  public function getLastName() {
    return $this->lastname;
  }

  public function getFullName() {
    return sprintf("%s %s %s", $this->firstname, $this->middleinitial, $this->lastname);
  }

  // TODO: add constraints to ensure proper formatting
  public function setEmail($email) {
    $this->email = $email;

    return $this;
  }

  public function getEmail() {
    return $this->email;
  }

  // TODO: add constraints to ensure proper formatting
  public function setPhoneNumber($number) {
    $this->phonenumber = $number;

    return $this;
  }

  public function getPhoneNumber() {
    return $this->phonenumber;
  }
}
