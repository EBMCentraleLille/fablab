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
use CentraleLille\ReservationBundle\Entity\Bookables\Machine;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use CentraleLille\ReservationBundle\Entity\Booking\Event;
use Symfony\Component\HttpFoundation\Request;
use CentraleLille\ReservationBundle\Entity\Bookables\Type;

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

        $repository = $em->getRepository('ReservationBundle:Bookables\Machine');

        $machines = $repository->findAll();

        $types = $em->getRepository('ReservationBundle:Bookables\Type');

        // machines fitering

        $machinesAvailables = array();
        $machinesUnavailables = array();
        $machinesOutOfOrder = array();
        $machinesBeingTested = array();

        foreach ($machines as $machine) {
            switch ($machine->getStatut()) {
                case 'Disponible':
                    array_push($machinesAvailables, $machine);
                    break;
                case 'Indisponible':
                    array_push($machinesUnavailables, $machine);
                    break;
                case 'Hors Service':
                    array_push($machinesOutOfOrder, $machine);
                    break;
                case 'En Test':
                    array_push($machinesBeingTested, $machine);
                    break;
            }

        }

        return $this->render(
            'ReservationBundle::booking.html.twig',
            array(
                'machinesAvailables'=>$machinesAvailables,
                'machinesUnavailables'=>$machinesUnavailables,
                'machinesOutOfOrder'=>$machinesOutOfOrder,
                'machinesBeingTested'=>$machinesOutOfOrder,
                'types'=>$types
                )
        );
    }

    public function viewResourceAction($resourceType, $id)
    {
        switch ($resourceType) {
            case 'machine':
                $em = $this->getDoctrine()->getManager();
                $repository = $em->getRepository('ReservationBundle:Bookables\Machine');

                if (is_numeric($id)) {
                    $machine = $repository ->find($id);
                    if (! is_null($machine)) { //if machine id is good, display planning
                        return $this->render(
                            'ReservationBundle::resourceBooking.html.twig',
                            array('machine'=>$machine)
                        );
                    } else { //if this machine id does not return something, do smthg else
                        $machines = $repository->findAll();
                        return $this->render(
                            'ReservationBundle::reservation.html.twig',
                            array('machines'=>$machines)
                        );
                    }

                } else { // if id is not a number, go back
                    $machines = $repository->findAll();
                    return $this->render(
                        'ReservationBundle::reservation.html.twig',
                        array('machines'=>$machines)
                    );
                }
                break;
            case 'room':
                break;
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

        $repository = $em->getRepository('ReservationBundle:Bookables\Machine');

        $machines = $repository->findAll();


        return $this->render(
            'admin_list_resources.html.twig',
            array('machines'=>$machines)
        );
    }
}
