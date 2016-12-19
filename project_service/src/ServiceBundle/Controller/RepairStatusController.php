<?php

namespace ServiceBundle\Controller;

use ServiceBundle\ServiceEvents;
use ServiceBundle\Event\FlashEvent;
use ServiceBundle\Entity\Repair_status;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Repair_status controller.
 *
 * @Route("repair_status")
 */
class RepairStatusController extends Controller
{
    /**
     * Lists all repair_status entities.
     *
     * @Route("/", name="repair_status_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $repairStatuses = $em->getRepository('ServiceBundle:Repair_status')->findAll();

        return $this->render('repair_status/index.html.twig', array(
            'repair_statuses' => $repairStatuses,
        ));
    }

    /**
     * Creates a new repair_status entity.
     *
     * @Route("/new", name="repair_status_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $repairStatus = new Repair_status();
        $form = $this->createForm('ServiceBundle\Form\Repair_statusType', $repairStatus);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($repairStatus);
            $em->flush($repairStatus);
            
            $dispatcher = $this->get('event_dispatcher');
            $event = new FlashEvent($repairStatus, $request);
            $dispatcher->dispatch(ServiceEvents::REPAIR_STATUS_ADDED, $event);

            return $this->redirectToRoute('repair_status_show', array('id' => $repairStatus->getId()));
        }

        return $this->render('repair_status/new.html.twig', array(
            'repair_status' => $repairStatus,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a repair_status entity.
     *
     * @Route("/{id}", name="repair_status_show")
     * @Method("GET")
     */
    public function showAction(Repair_status $repairStatus)
    {
        $deleteForm = $this->createDeleteForm($repairStatus);

        return $this->render('repair_status/show.html.twig', array(
            'repair_status' => $repairStatus,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing repair_status entity.
     *
     * @Route("/{id}/edit", name="repair_status_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Repair_status $repairStatus)
    {
        $deleteForm = $this->createDeleteForm($repairStatus);
        $editForm = $this->createForm('ServiceBundle\Form\Repair_statusType', $repairStatus);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            
            $dispatcher = $this->get('event_dispatcher');
            $event = new FlashEvent($repairStatus, $request);
            $dispatcher->dispatch(ServiceEvents::REPAIR_STATUS_EDITED, $event);

            return $this->redirectToRoute('repair_status_edit', array('id' => $repairStatus->getId()));
        }

        return $this->render('repair_status/edit.html.twig', array(
            'repair_status' => $repairStatus,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a repair_status entity.
     *
     * @Route("/{id}", name="repair_status_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Repair_status $repairStatus)
    {
        $form = $this->createDeleteForm($repairStatus);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($repairStatus);
            $em->flush($repairStatus);
            
            $dispatcher = $this->get('event_dispatcher');
            $event = new FlashEvent($repairStatus, $request);
            $dispatcher->dispatch(ServiceEvents::REPAIR_STATUS_DELETED, $event);
        }

        return $this->redirectToRoute('repair_status_index');
    }

    /**
     * Creates a form to delete a repair_status entity.
     *
     * @param Repair_status $repairStatus The repair_status entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Repair_status $repairStatus)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('repair_status_delete', array('id' => $repairStatus->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
