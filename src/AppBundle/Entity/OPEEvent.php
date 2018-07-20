<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Mapping\Entity
 * @Mapping\Table(name="ope_event")
 */
class OPEEvent implements ListInterface
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
  private $title;

  /**
   * @Mapping\Column(type="decimal", scale=1)
   * @Assert\Type(type="float")
   */
  private $ceHours;

  /**
   * @Mapping\Column(type="array")
   * @Assert\All({
   *    @Assert\Date()
   * })
   */
  private $dates;

  /**
   * @Mapping\ManyToMany(targetEntity="Attendee", mappedBy="opeEvents")
   */
  private $attendees;

  public function __construct() {
    $this->dates = [];
    $this->attendees = new ArrayCollection();
  }

  public function __toString() {
    return $this->title;
  }

  public function getId() {
    return $this->id;
  }

  public function setTitle($title) {
    $this->title = $title;

    return $this;
  }

  public function getTitle() {
    return $this->title;
  }

  public function setCEHours($hours) {
    $this->ceHours = $hours;

    return $this;
  }

  public function getCEHours() {
    return $this->ceHours;
  }

  public function setDates($dates) {
    $this->dates = $dates;

    return $this;
  }

  public function addDate($date) {
    $this->dates[] = $date;

    return $this;
  }

  public function removeDate($date) {
    $pos = array_search($date, $this->dates);

    array_splice($this->dates, $pos, 1);

    return $this;
  }

  public function getDates() {
    return $this->dates;
  }

  public function getAttendees() {
    return $this->attendees;
  }

  public function addAttendee(\AppBundle\Entity\Attendee $attendee) {
    if( $this->attendees->contains($attendee) ) {
      return false;
    }

    $this->attendees->add($attendee);
    $attendee->addOPEEvent($this);

    return $this;
  }

  public function removeAttendee(\AppBundle\Entity\Attendee $attendee) {
    if( !$this->attendees->contains($attendee) ) {
      return false;
    }

    $removed = $this->attendees->removeElement($attendee);
    $attendee->removeOPEEvent($this);

    return $removed;
  }

  public function toListItem() {
    $title = htmlspecialchars($this->title);
    $ceHours = htmlspecialchars($this->ceHours);

    return "<tr><td>$title</td><td>$ceHours</td></tr>";
  }

  public function getSummary() {
    
  }
}
