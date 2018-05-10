<?php

namespace AppBundle\DataFixtures;

use AppBundle\Entity\Attendee;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class OPEFixtures extends Fixture
{
    public function load(ObjectManager $manager) {
        $attendee = new Attendee();

        $attendee->setFirstName("First")
          ->setMiddleInitial("M.")
          ->setLastName("Last")
          ->setEmail("email@example.com")
          ->setPhoneNumber("555-555-5555");

        $manager->persist($attendee);
        $manager->flush();
    }
}
