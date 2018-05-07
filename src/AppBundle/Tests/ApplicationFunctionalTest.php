<?php

namespace AppBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApplicationFunctionalTest extends WebTestCase
{
  /**
   * @dataProvider urlProvider
   */
  public function testPageIsSuccessful($url) {
    $client = static::createClient();
    $client->request('GET', $url);

    $this->assertTrue($client->getResponse()->isSuccessful());
  }

  public function urlProvider() {
    return array(
      array('/'),
      array('/event/'),
      array('/event/new'),
      array('/attendee/'),
      array('/attendee/new'),
    );
  }
}
