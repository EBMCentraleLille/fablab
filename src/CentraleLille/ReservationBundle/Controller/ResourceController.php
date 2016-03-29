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
 * Resource controller
 *
 * @category Controller
 * @package  Reservation Bundle
 * @author   Pierre-Louis Bonnart <plbonnart@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/pierloui/fablab
 */

class ResourceController extends Controller
{
    /**
     *
     * @return Response
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();

        $repository = $em->getRepository('ReservationBundle:Bookables\Machine');

        $machines = $repository->findAll();

        $em = $this->getDoctrine()->getManager();

        $repository = $em->getRepository('ReservationBundle:Bookables\Salle');

        $rooms = $repository->findAll();

        $em = $this->getDoctrine()->getManager();

        $repository = $em->getRepository('ReservationBundle:Bookables\Casier');

        $casiers = $repository->findAll();


        return $this->render(
            '@Reservation/resourcesList.html.twig',
            array(
                'machines'=>$machines,
                'rooms'=>$rooms,
                'casiers'=>$casiers
            )
        );
    }
    /**
     *
     * @return Response
     */
    public function viewAction($resourceType, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $bookable = "";
        switch ($resourceType) {
            case 'machine':
                $repository = $em->getRepository('ReservationBundle:Bookables\Machine');
                $bookable = $repository ->find($id);
                break;
            case 'room':
                $repository = $em->getRepository('ReservationBundle:Bookables\Salle');
                $bookable = $repository ->find($id);
                break;
            case 'casier':
                $repository = $em->getRepository('ReservationBundle:Bookables\Casier');
                $bookable = $repository ->find($id);
                break;
        }

        return $this->render(
            '@Reservation/resource.html.twig',
            array(
                'resourcetype'=>$resourceType,
                'bookable'=>$bookable
            )
        );
    }
}
