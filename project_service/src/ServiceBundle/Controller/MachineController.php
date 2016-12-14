<?php

namespace ServiceBundle\Controller;

use ServiceBundle\Entity\Machine;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * 
 * Machine controller.
 * @Route("machine")
 * 
 */
class MachineController extends Controller {

    /**
     * Lists all machine entities.
     *
     * @Route("/", name="machine_index")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $machines = $em->getRepository('ServiceBundle:Machine')->findAll();

        return $this->render('machine/index.html.twig', array(
                    'machines' => $machines,
        ));
    }

    /**
     * Lists machine entities with sended status.
     *
     * @Route("/sent", name="machine_index_sent")
     * @Method("GET")
     */
    public function indexSentAction() {
        $em = $this->getDoctrine()->getManager();

        $machines = $em->getRepository('ServiceBundle:Machine')->findByrepairStatus(3);

        return $this->render('machine/index_sent.html.twig', array(
                    'machines' => $machines,
        ));
    }

    /**
     * Lists machine entities with repaired status.
     *
     * @Route("/repaired", name="machine_index_repaired")
     * @Method("GET")
     */
    public function indexRepairedAction() {
        $em = $this->getDoctrine()->getManager();

        $machines = $em->getRepository('ServiceBundle:Machine')->findByrepairStatus(2);

        return $this->render('machine/index_repaired.html.twig', array(
                    'machines' => $machines,
        ));
    }

    /**
     * Lists machine entities with not repaired status.
     *
     * @Route("/notrepaired", name="machine_index_not_repaired")
     * @Method("GET")
     */
    public function indexNotRepairedAction() {
        $em = $this->getDoctrine()->getManager();

        $machines = $em->getRepository('ServiceBundle:Machine')->findByrepairStatus(1);

        return $this->render('machine/index_not_repaired.html.twig', array(
                    'machines' => $machines,
        ));
    }

    /**
     * Creates a new machine entity.
     *
     * @Route("/new", name="machine_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {
        $machine = new Machine();
        $form = $this->createForm('ServiceBundle\Form\MachineType', $machine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $instime = new \DateTime("now");
            $machine->setInsertionDate($instime);
            if ($machine->getRepairStatus()->getId() != 1) {
                $reptime = new \DateTime("now");
                $machine->setRepairDate($reptime);
            }
            $em->persist($machine);
            $em->flush($machine);
            
            $request->getSession()->getFlashbag()
                    ->add('success', "New machine: " . $machine->getComplaintNumber() . " has been added");

            return $this->redirectToRoute('machine_show', array('id' => $machine->getId()));
        }

        return $this->render('machine/new.html.twig', array(
                    'machine' => $machine,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a machine entity.
     *
     * @Route("/{id}", name="machine_show",  requirements={"id": "\d+"})
     * @Method("GET")
     */
    public function showAction(Machine $machine) {
        $deleteForm = $this->createDeleteForm($machine);

        return $this->render('machine/show.html.twig', array(
                    'machine' => $machine,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing machine entity.
     *
     * @Route("/{id}/edit", name="machine_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Machine $machine) {
        $deleteForm = $this->createDeleteForm($machine);
        $editForm = $this->createForm('ServiceBundle\Form\MachineType', $machine)->add('insertionDate')->add('repairDate');
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            
            $request->getSession()->getFlashbag()
                    ->add('success', "Machine: " . $machine->getComplaintNumber() . " has been edited");

            return $this->redirectToRoute('machine_edit', array('id' => $machine->getId()));
        }

        return $this->render('machine/edit.html.twig', array(
                    'machine' => $machine,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to add repair description to existing machine entity.
     *
     * @Route("/{id}/repair", name="machine_repair")
     * @Method({"GET", "POST"})
     */
    public function repairAction(Request $request, Machine $machine) {

        $repairForm = $this->createFormBuilder($machine)->add('repairDescription')->getForm();
        $repairForm->handleRequest($request);

        if ($repairForm->isSubmitted() && $repairForm->isValid()) {

            $reptime = new \DateTime("now");
            $machine->setRepairDate($reptime);

            $em = $this->getDoctrine()->getManager();
            $status = $em->getRepository('ServiceBundle:Repair_status')->find(2);
            $machine->setRepairStatus($status);

            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('machine_servicedoc', array ('id' => $machine->getId()));
        }

        return $this->render('machine/repair.html.twig', array(
                    'machine' => $machine,
                    'repair_form' => $repairForm->createView(),
        ));
    }
    

    /**
     * Seting up 'sended' status to existing machine entity.
     *
     * @Route("/{id}/send", name="machine_send")
     * @Method({"GET"})
     */
    public function SendAction(Request $request, Machine $machine) {

        $em = $this->getDoctrine()->getManager();
        $sendedStatus = $em->getRepository('ServiceBundle:Repair_status')->find(3);
        $machine->setRepairStatus($sendedStatus);

        $this->getDoctrine()->getManager()->flush();
        
        $request->getSession()->getFlashbag()
                    ->add('success', "Machine: " . $machine->getComplaintNumber() . " repair status has been set to \"sended\"");
        
        return $this->redirectToRoute('machine_index_repaired');
    }

    /**
     * Create service doc for existing machine entity.
     *
     * @Route("/{id}/servicedoc", name="machine_servicedoc")
     * @Method({"GET"})
     */
    public function ServiceDocAction(Request $request, Machine $machine) {

        $html = $this->renderView('service_document/show.html.twig', array(
            'machine' => $machine,
        ));
        $mpdfService = $this->get('tfox.mpdfport');
        return $response = $mpdfService->generatePdfResponse($html);
    }

    /**
     * Deletes a machine entity.
     *
     * @Route("/{id}", name="machine_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Machine $machine) {
        $form = $this->createDeleteForm($machine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($machine);
            $em->flush($machine);
            
            $request->getSession()->getFlashbag()
                    ->add('success', "Machine: " . $machine->getComplaintNumber() . " has been deleted");
        }

        return $this->redirectToRoute('machine_index');
    }

    /**
     * Creates a form to delete a machine entity.
     *
     * @param Machine $machine The machine entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Machine $machine) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('machine_delete', array('id' => $machine->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
