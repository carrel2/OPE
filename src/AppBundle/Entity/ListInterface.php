<?php

namespace AppBundle\Entity;

interface ListInterface
{
  public function toListItem();
  public function getSummary();
}
