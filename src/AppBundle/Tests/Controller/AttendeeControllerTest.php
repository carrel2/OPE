<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AttendeeControllerTest extends WebTestCase
{
    public function testCompleteScenario()
    {
        // Create a new client to browse the application
        $client = static::createClient();

        // Create a new entry in the database
        $crawler = $client->request('GET', '/attendee/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /attendee/");
        $crawler = $client->click($crawler->selectLink('Create a new attendee')->link());

        // Fill in the form and submit it
        $form = $crawler->selectButton('Create')->form(array(
            'appbundle_attendee[firstname]'  => 'John',
            'appbundle_attendee[middleinitial]'  => 'H.',
            'appbundle_attendee[lastname]'  => 'Doe',
            'appbundle_attendee[email]'  => 'email@example.com',
            'appbundle_attendee[phonenumber]'  => '555-555-5555',
            // ... other fields to fill
        ));

        $crawler = $client->submit($form);
        $this->assertGreaterThan(0, $crawler->filter('span.help.is-danger')->count());

        $form = $crawler->selectButton('Create')->form(array(
            'appbundle_attendee[firstname]'  => 'John',
            'appbundle_attendee[middleinitial]'  => 'H.',
            'appbundle_attendee[lastname]'  => 'Doe',
            'appbundle_attendee[email]'  => 'john.doe@example.com',
            'appbundle_attendee[phonenumber]'  => '555 555-5555',
            // ... other fields to fill
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check data in the show view
        $this->assertGreaterThan(0, $crawler->filter('td:contains("John")')->count(), 'Missing element td:contains("Test")');

        // Edit the entity
        $crawler = $client->click($crawler->selectLink('Edit')->link());

        $form = $crawler->selectButton('Update')->form(array(
          'appbundle_attendee[firstname]'  => 'Alan',
          'appbundle_attendee[middleinitial]'  => 'M.',
          'appbundle_attendee[lastname]'  => 'Turing',
          'appbundle_attendee[email]'  => 'alan.turing@example.com',
          'appbundle_attendee[phonenumber]'  => '(555) 555-5555',
            // ... other fields to fill
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check the element contains an attribute with value equals "Foo"
        $this->assertGreaterThan(0, $crawler->filter('[value="Alan"]')->count(), 'Missing element [value="Foo"]');

        // Delete the entity
        $client->submit($crawler->selectButton('Delete')->form());
        $crawler = $client->followRedirect();

        // Check the entity has been delete on the list
        $this->assertNotRegExp('/Foo/', $client->getResponse()->getContent());
    }
}
