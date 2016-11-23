<?php

namespace ServiceBundle\Controller;

use ServiceBundle\Entity\ModelMachine;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Modelmachine controller.
 *
 * @Route("modelmachine")
 */
class ModelMachineController extends Controller
{
    /**
     * Lists all modelMachine entities.
     *
     * @Route("/", name="modelmachine_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $modelMachines = $em->getRepository('ServiceBundle:ModelMachine')->findAll();

        return $this->render('modelmachine/index.html.twig', array(
            'modelMachines' => $modelMachines,
        ));
    }

    /**
     * Creates a new modelMachine entity.
     *
     * @Route("/new", name="modelmachine_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $modelMachine = new Modelmachine();
        $form = $this->createForm('ServiceBundle\Form\ModelMachineType', $modelMachine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($modelMachine);
            $em->flush($modelMachine);

            return $this->redirectToRoute('modelmachine_show', array('id' => $modelMachine->getId()));
        }

        return $this->render('modelmachine/new.html.twig', array(
            'modelMachine' => $modelMachine,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a modelMachine entity.
     *
     * @Route("/{id}", name="modelmachine_show")
     * @Method("GET")
     */
    public function showAction(ModelMachine $modelMachine)
    {
        $deleteForm = $this->createDeleteForm($modelMachine);

        return $this->render('modelmachine/show.html.twig', array(
            'modelMachine' => $modelMachine,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing modelMachine entity.
     *
     * @Route("/{id}/edit", name="modelmachine_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ModelMachine $modelMachine)
    {
        $deleteForm = $this->createDeleteForm($modelMachine);
        $editForm = $this->createForm('ServiceBundle\Form\ModelMachineType', $modelMachine);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('modelmachine_edit', array('id' => $modelMachine->getId()));
        }

        return $this->render('modelmachine/edit.html.twig', array(
            'modelMachine' => $modelMachine,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a modelMachine entity.
     *
     * @Route("/{id}", name="modelmachine_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ModelMachine $modelMachine)
    {
        $form = $this->createDeleteForm($modelMachine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($modelMachine);
            $em->flush($modelMachine);
        }

        return $this->redirectToRoute('modelmachine_index');
    }

    /**
     * Creates a form to delete a modelMachine entity.
     *
     * @param ModelMachine $modelMachine The modelMachine entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ModelMachine $modelMachine)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('modelmachine_delete', array('id' => $modelMachine->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
