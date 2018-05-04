<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
      $doctrine = $this->getDoctrine();
      $events = $doctrine->getRepository('AppBundle:OPEEvent')->findAll();
      $attendees = $doctrine->getRepository('AppBundle:Attendee')->findAll();

      return $this->render('default/index.html.twig', array(
          'events' => $events,
          'attendees' => $attendees,
      ));
    }
}
