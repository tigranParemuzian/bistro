<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotAcceptableHttpException;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function indexAction(Request $request)
    {
        $user = $this->getUser();

        if(!$user) {

            throw new NotAcceptableHttpException('User not found');
        }

        if($this->isGranted('ROLE_ADMIN', $user)) {
           return $this->redirectToRoute('sonata_admin_dashboard');
        } elseif ($this->isGranted('ROLE_KITCHENER', $user)) {

            return $this->redirectToRoute('kitchener_index');
        } elseif ($this->isGranted('ROLE_CASHIER', $user)) {

        }
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ));
    }

    /**
     *
     * @Route("/", name="homepage")
     */
    public function homeAction()
    {

    }
}
