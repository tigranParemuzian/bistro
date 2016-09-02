<?php

namespace AppBundle\Controller\Rest;

use AppBundle\Entity\Booking;
use AppBundle\Entity\User;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping\JoinColumn;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\DateTime;


/**
 * Created by PhpStorm.
 * User: developer-01
 * Date: 9/2/16
 * Time: 5:34 PM
 */
class BookingController extends FOSRestController
{
    /**
     *
     * @ApiDoc(
     *  resource=true,
     *  section="Booking",
     *  description="This function is used to get all new bookings.",
     *  statusCodes={
     *         202="Returned when find",
     *         404="Return when new bookings not found", }
     * )
     *
     * This function is used to get all new bookings
     * @Rest\View(serializerGroups={"booking_list"})
     *
     */
    public function getAction()
    {
        // get current user
        $currentUser = $this->getUser();
        // check isset user and user security role
        if(!is_object($currentUser)) {
            $translated = $this->get('translator')->trans('erorrs.user.not_found');
            return new JsonResponse($translated , Response::HTTP_FORBIDDEN);
        }

        // get entity manager
        $em = $this->getDoctrine()->getManager();
        // get driver settings
        $bookings = $em->getRepository('AppBundle:Booking')->find(array('status'=>0));

        if(!$bookings) {

            $translated = $this->get('translator')->trans('erorrs.booking.not_found');
            return new JsonResponse($translated, Response::HTTP_NOT_FOUND);
        }

        return $bookings;
    }

    /**
     *
     * @ApiDoc(
     *  resource=true,
     *  section="Booking",
     *  description="This function is used to get all new bookings.",
     *  statusCodes={
     *         202="Returned when find",
     *         404="Return when new bookings not found", }
     * )
     *
     * This function is used to get all new bookings
     * @Rest\View(serializerGroups={"booking_list"})
     *
     */
    public function getBySlugAction($slug)
    {
        // get current user
        $currentUser = $this->getUser();
        // check isset user and user security role
        if(!is_object($currentUser)) {
            $translated = $this->get('translator')->trans('erorrs.user.not_found');
            return new JsonResponse($translated , Response::HTTP_FORBIDDEN);
        }

        // get entity manager
        $em = $this->getDoctrine()->getManager();
        // get driver settings
        $bookings = $em->getRepository('AppBundle:Booking')->findOneBy(array('slug'=>$slug));

        if(!$bookings) {

            $translated = $this->get('translator')->trans('erorrs.booking.not_found');
            return new JsonResponse($translated, Response::HTTP_NOT_FOUND);
        }

        return $bookings;
    }

}