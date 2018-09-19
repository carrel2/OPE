<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Attendee;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Attendee controller.
 *
 * @Route("attendee")
 */
class AttendeeController extends Controller
{
    /**
     * Lists all attendee entities.
     *
     * @Route("/", name="attendee_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $attendees = $em->getRepository('AppBundle:Attendee')->findAll();

        return $this->render('attendee/index.html.twig', array(
            'attendees' => $attendees,
        ));
    }

    /**
     * Creates a new attendee entity.
     *
     * @Route("/new", name="attendee_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $attendee = new Attendee();
        $form = $this->createForm('AppBundle\Form\AttendeeType', $attendee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($attendee);
            $em->flush();

            $response = new JsonResponse();
            $response->setData(array(
              'id' => "attendees",
              'text' => $this->renderView('ajax/attendee.html.twig', array(
                'attendee' => $attendee,
              )),
            ));

            return $response;
        }

        return new Response($this->renderView('attendee/new.html.twig', array(
            'attendee' => $attendee,
            'form' => $form->createView(),
        )));
    }

    /**
     * Finds and displays a attendee entity.
     *
     * @Route("/{id}", name="attendee_show")
     * @Method("GET")
     */
    public function showAction(Attendee $attendee)
    {
        $deleteForm = $this->createDeleteForm($attendee);

        return new Response($this->renderView('attendee/show.html.twig', array(
            'attendee' => $attendee,
        )));
    }

    /**
     * Displays a form to edit an existing attendee entity.
     *
     * @Route("/{id}/edit", name="attendee_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Attendee $attendee)
    {
        $deleteForm = $this->createDeleteForm($attendee);
        $editForm = $this->createForm('AppBundle\Form\AttendeeType', $attendee);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('homepage');
        }

        return $this->render('attendee/edit.html.twig', array(
            'attendee' => $attendee,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a attendee entity.
     *
     * @Route("/{id}", name="attendee_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Attendee $attendee)
    {
        $form = $this->createDeleteForm($attendee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($attendee);
            $em->flush();
        }

        return $this->redirectToRoute('attendee_index');
    }

    /**
     * Creates a form to delete a attendee entity.
     *
     * @param Attendee $attendee The attendee entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Attendee $attendee)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('attendee_delete', array('id' => $attendee->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * @Route("/report/{id}", name="attendee_report")
     */
    public function reportAction(Request $r, Attendee $attendee)
    {
      return $this->render('default/report.html.twig', array(
        'base_object' => $attendee,
        'list' => $attendee->getOPEEvents(),
      ));
    }
}
