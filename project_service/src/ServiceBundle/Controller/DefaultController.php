<?php

namespace ServiceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller {

    /**
     * Main page.
     *
     * @Route("/", name="index")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $machines = $em->getRepository('ServiceBundle:Machine')->findAll();

        return $this->render('machine/index.html.twig', array(
                    'machines' => $machines,
        ));
    }

}
