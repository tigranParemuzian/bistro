<?php
/**
 * Created by PhpStorm.
 * User: developer-01
 * Date: 8/30/16
 * Time: 2:28 PM
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class KitchenerController extends Controller
{

    /**
     * @Route("/kitchener", name="kitchener_index")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $products = $em->getRepoaitory('AppBundle:Products')->findAll();
        return array('d'=>'ff');


    }
}