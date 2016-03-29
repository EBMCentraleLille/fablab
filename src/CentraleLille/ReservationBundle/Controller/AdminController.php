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
 * Admin controller
 *
 * @category Controller
 * @package  Reservation Bundle
 * @author   Pierre-Louis Bonnart <plbonnart@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/pierloui/fablab
 */

class AdminController extends Controller
{
    /**
     *
     * @return Response
     */
    public function adminResourcesAction()
    {
        $em = $this->getDoctrine()->getManager();

        $repository = $em->getRepository('CentraleLille\ReservationBundle\Entity\Bookables\Machine');
        $repository_type = $em->getRepository('CentraleLille\ReservationBundle\Entity\Bookables\Type');

        $types = $repository_type->findAll();

        $machines = $repository->findAll();

        $currentUser = $this->getUser();

        return $this->render(
            'ReservationBundle::admin_list_resources.html.twig',
            array(
                'machines'=>$machines,
                'types'=>$types,
                'currentUser'=>$currentUser
            )
        );
    }

    /**
     *
     * @return Response
     */
    public function adminEventsAction()
    {
        $em = $this->getDoctrine()->getManager();

        $repository = $em->getRepository('CentraleLille\ReservationBundle\Entity\Bookables\Machine');
        $repository_type = $em->getRepository('CentraleLille\ReservationBundle\Entity\Bookables\Type');

        $types = $repository_type->findAll();

        $machines = $repository->findAll();

        $currentUser = $this->getUser();

        return $this->render(
            'ReservationBundle::admin_list_events.html.twig',
            array(
                'machines'=>$machines,
                'types'=>$types,
                'currentUser'=>$currentUser
            )
        );
    }
}
