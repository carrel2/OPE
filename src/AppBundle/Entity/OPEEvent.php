<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @Mapping\Entity
 * @Mapping\Table(name="ope_event")
 */
class OPEEvent
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
   * @Mapping\Column(type="array")
   * @Assert\All({
   *    @Assert\Date()
   * })
   */
  private $dates;

  public function __construct() {
    $this->dates = [];
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
}
