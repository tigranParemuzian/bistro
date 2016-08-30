<?php
/**
 * Created by PhpStorm.
 * User: developer-01
 * Date: 8/30/16
 * Time: 2:28 PM
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class KitchenerController extends Controller
{

    /**
     * @Route("/kitchener", name="kitchener_index")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();



    }
}