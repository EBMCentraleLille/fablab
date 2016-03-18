<?php

/**
 * PHP Version 5.5
 *
 * @Category Controller
 * @Package  Reservation
 * @author   Skikar El Mehdi <skikar.elmehdi@gmail.com>
 * @Licence  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @Link     https://github.com/pierloui/fablab
 */

namespace CentraleLille\ReservationBundle\Controller;

use ADesigns\CalendarBundle\Event\CalendarEvent;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use CentraleLille\ReservationBundle\Entity\Machine;
use Symfony\Component\HttpFoundation\Request;

/**
 * Controller Class Doc
 *
 * Contrôleur associé au type Event
 *
 * @category Controller
 * @package  Reservation Bundle
 * @author   Skikar El Mehdi <skikar.elmehdi@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/pierloui/fablab
 */

class EventController extends Controller
{
    /**
     * reserverAction
     *
     * Génère un formulaire permettant de réserver une machine à une date donnée
     *
     * @param  Request $request Récupère les données envoyés en POST
     *
     * @return Redirect
     */

    public function bookAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $repository = $em->getRepository('ReservationBundle:Machine');

        $machines = $repository->findAll();

        return $this->render(
            'ReservationBundle::booking.html.twig',
            array('machines'=>$machines)
        );
    }

    public function viewResourceAction($id)
    {
        if (is_numeric($id)) {
            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('ReservationBundle:Machine');

            $machine = $repository ->find($id);

            if (! is_null($machine)) { //if machine id is good, display planning
                return $this->render(
                    'ReservationBundle::resourceBooking.html.twig',
                    array('machine'=>$machine)
                );
            } else { //if this machine id does not return something, do smthg else
                $em = $this->getDoctrine()->getManager();

                $repository = $em->getRepository('ReservationBundle:Machine');

                $machines = $repository->findAll();

                return $this->render(
                    'ReservationBundle::reservation.html.twig',
                    array('machines'=>$machines)
                );
            }

        } else { // if id is not a number, go back
            $em = $this->getDoctrine()->getManager();

            $repository = $em->getRepository('ReservationBundle:Machine');

            $machines = $repository->findAll();

            return $this->render(
                'ReservationBundle::reservation.html.twig',
                array('machines'=>$machines)
            );
        }
    }


    /**
     * adminAction
     *
     * Fonction permettant de lister les machines afin de donner la possibilité de supprimer / modifier à l'admin
     *
     * @return Response
     */

    public function adminAction()
    {
        $em = $this->getDoctrine()->getManager();

        $repository = $em->getRepository('ReservationBundle:Machine');

        $machines = $repository->findAll();


        return $this->render(
            'ReservationBundle::admin.html.twig',
            array('machines'=>$machines)
        );
    }
}
