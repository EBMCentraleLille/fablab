<?php

/**
 * PHP Version 5.5
 *
 * @category Controller
 * @package  Reservation
 * @author   Skikar El Mehdi <skikar.elmehdi@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/pierloui/fablab
 */

namespace CentraleLille\ReservationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Controller Class Doc
 *
 * Contrôleur par défaut pour la gestion du site et ses redirections
 *
 * @category Controller
 * @package  Reservation_Bundle
 * @author   Skikar El Mehdi <skikar.elmehdi@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/pierloui/fablab
 */

class DefaultController extends Controller
{
    /**
     * @return Response
     */
    public function indexAction()
    {
        // En attendant de récupérer directement le $user pour avoir ses informations perso.
        return $this->render(
            'ReservationBundle:Default:index.html.twig'
        );
    }

    /**
     * @return Response
     */

    public function salleAction()
    {
        return new Response("Ici on va réserver la salle");
    }

    /**
     * @return Response
     */

    public function casierAction()
    {
        return new Response("Ici on va réserver les casiers");
    }


    /**
     * @return Response
     */

    public function bookingListAction()
    {
        $em = $this->getDoctrine()->getManager();

        $repository = $em->getRepository('ReservationBundle:Booking\Event');
        $events = $repository->findAll();

        return $this->render(
            'ReservationBundle::bookingList.html.twig',
            array('events'=>$events)
        );

    }
}
