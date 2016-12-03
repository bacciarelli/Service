<?php

namespace ServiceBundle\Controller;

use ServiceBundle\Entity\Repair_status;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

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

        $repair_statuses = $em->getRepository('ServiceBundle:Repair_status')->findAll();

        return $this->render('repair_status/index.html.twig', array(
            'repair_statuses' => $repair_statuses,
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
        $repair_status = new Repair_status();
        $form = $this->createForm('ServiceBundle\Form\Repair_statusType', $repair_status);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($repair_status);
            $em->flush($repair_status);

            return $this->redirectToRoute('repair_status_show', array('id' => $repair_status->getId()));
        }

        return $this->render('repair_status/new.html.twig', array(
            'repair_status' => $repair_status,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a repair_status entity.
     *
     * @Route("/{id}", name="repair_status_show")
     * @Method("GET")
     */
    public function showAction(Repair_status $repair_status)
    {
        $deleteForm = $this->createDeleteForm($repair_status);

        return $this->render('repair_status/show.html.twig', array(
            'repair_status' => $repair_status,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing repair_status entity.
     *
     * @Route("/{id}/edit", name="repair_status_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Repair_status $repair_status)
    {
        $deleteForm = $this->createDeleteForm($repair_status);
        $editForm = $this->createForm('ServiceBundle\Form\Repair_statusType', $repair_status);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('repair_status_edit', array('id' => $repair_status->getId()));
        }

        return $this->render('repair_status/edit.html.twig', array(
            'repair_status' => $repair_status,
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
    public function deleteAction(Request $request, Repair_status $repair_status)
    {
        $form = $this->createDeleteForm($repair_status);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($repair_status);
            $em->flush($repair_status);
        }

        return $this->redirectToRoute('repair_status_index');
    }

    /**
     * Creates a form to delete a repair_status entity.
     *
     * @param Repair_status $repair_status The repair_status entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Repair_status $repair_status)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('repair_status_delete', array('id' => $repair_status->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
