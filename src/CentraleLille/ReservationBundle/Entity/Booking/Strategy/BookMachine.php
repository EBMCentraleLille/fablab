<?php
/**
 * Created by PhpStorm.
 * User: windownet
 * Date: 21/03/2016
 * Time: 09:38
 */

namespace CentraleLille\ReservationBundle\Entity\Booking\Strategy;

use CentraleLille\ReservationBundle\Entity\Bookables\Bookable;
use Doctrine\ORM\EntityManager;
use CentraleLille\ReservationBundle\Entity\Booking\Event;
use CentraleLille\CustomFosUserBundle\Entity\Project;
use Symfony\Component\Validator\Constraints\DateTime;
use CentraleLille\CustomFosUserBundle\Entity\User;
use Doctrine\ORM\Mapping;

class BookMachine extends BookStrategy
{
    protected $em;
    protected $repository;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->repository = $em->getRepository('ReservationBundle:Machine');
    }

    public function book(User $user, Project $project, DateTime $start, DateTime $end, Bookable $machine)
    {
        $em = $this->em;

        if ($this->isAvailableForPeriod($machine, $start, $end, $this->repository)) {
            $event = new Event();
            $event->setCreationDateTime();
            $event->setStartDateTime($start);
            $event->setEndDateTime($end);
            $event->setBookable($machine);
            $event->setProject($project);
            $event->setUser($user);
            $event->setStatus("En attente d'approbation");
            $em->persist($event);
            $em->flush();
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
    }
}
