<?php
/**
 * Created by PhpStorm.
 * User: windownet
 * Date: 21/03/2016
 * Time: 10:43
 */

namespace CentraleLille\ReservationBundle\Entity\Booking\Strategy;

use CentraleLille\ReservationBundle\Entity\Bookables\Salle;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Validator\Constraints\DateTime;
use CentraleLille\CustomFosUserBundle\Entity\User;
use CentraleLille\ReservationBundle\Entity\Booking\Event;
use CentraleLille\CustomFosUserBundle\Entity\Project;
use CentraleLille\ReservationBundle\Entity\Bookables\Bookable;

class BookSalle extends BookStrategy
{
    protected $repository;
    protected $em;

    /**
     * BookSalle constructor.
     * @param $repository
     * @param $em
     *
     **/

    public function __construct($repository, EntityManager $em)
    {
        $this->em = $em;
        $this->repository = $em->getRepository('ReservationBundle:Salle');
    }

    public function book(User $user, Project $project, DateTime $start, DateTime $end, Bookable $salle)
    {

        $repository = $this->getRepository();

        if ($this->isAvailableForPeriod($salle, $start, $end, $repository)) {

            $event = new Event();
            $event->setCreationDateTime();
            $event->setStartDateTime($start);
            $event->setEndDateTime($end);
            $event->setBookable($salle);
            $event->setUser($user);
            $this->em->persist($event);
            $this->em->flush();

            return true;
        } else {

            return false;
        }
    }

    public function release(Event $event)
    {
        $em = $this->em;
        $em->remove($event);
        $em->flush();
        return true;

    }

    /**
     * @return mixed
     */
    public function getRepository()
    {
        return $this->repository;
    }

    /**
     * @param mixed $repository
     */
    public function setRepository($repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return mixed
     */
    public function getEm()
    {
        return $this->em;
    }

    /**
     * @param mixed $em
     */
    public function setEm($em)
    {
        $this->em = $em;
    }
}
