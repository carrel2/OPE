<?php

namespace AppBundle\Controller;

use AppBundle\Entity\OPEEvent;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Opeevent controller.
 *
 * @Route("opeevent")
 */
class OPEEventController extends Controller
{
    /**
     * Lists all oPEEvent entities.
     *
     * @Route("/", name="opeevent_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $oPEEvents = $em->getRepository('AppBundle:OPEEvent')->findAll();

        return $this->render('opeevent/index.html.twig', array(
            'oPEEvents' => $oPEEvents,
        ));
    }

    /**
     * Creates a new oPEEvent entity.
     *
     * @Route("/new", name="opeevent_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $oPEEvent = new Opeevent();
        $form = $this->createForm('AppBundle\Form\OPEEventType', $oPEEvent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($oPEEvent);
            $em->flush();

            return $this->redirectToRoute('opeevent_show', array('id' => $oPEEvent->getId()));
        }

        return $this->render('opeevent/new.html.twig', array(
            'oPEEvent' => $oPEEvent,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a oPEEvent entity.
     *
     * @Route("/{id}", name="opeevent_show")
     * @Method("GET")
     */
    public function showAction(OPEEvent $oPEEvent)
    {
        $deleteForm = $this->createDeleteForm($oPEEvent);

        return $this->render('opeevent/show.html.twig', array(
            'oPEEvent' => $oPEEvent,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing oPEEvent entity.
     *
     * @Route("/{id}/edit", name="opeevent_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, OPEEvent $oPEEvent)
    {
        $deleteForm = $this->createDeleteForm($oPEEvent);
        $editForm = $this->createForm('AppBundle\Form\OPEEventType', $oPEEvent);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('opeevent_edit', array('id' => $oPEEvent->getId()));
        }

        return $this->render('opeevent/edit.html.twig', array(
            'oPEEvent' => $oPEEvent,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a oPEEvent entity.
     *
     * @Route("/{id}", name="opeevent_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, OPEEvent $oPEEvent)
    {
        $form = $this->createDeleteForm($oPEEvent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($oPEEvent);
            $em->flush();
        }

        return $this->redirectToRoute('opeevent_index');
    }

    /**
     * Creates a form to delete a oPEEvent entity.
     *
     * @param OPEEvent $oPEEvent The oPEEvent entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(OPEEvent $oPEEvent)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('opeevent_delete', array('id' => $oPEEvent->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
