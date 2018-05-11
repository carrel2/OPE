<?php

namespace AppBundle\DataFixtures;

use AppBundle\Entity\Attendee;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class OPEFixtures implements FixtureInterface
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
