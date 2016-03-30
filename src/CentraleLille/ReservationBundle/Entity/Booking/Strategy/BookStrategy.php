<?php

namespace CentraleLille\ReservationBundle\Entity\Booking\Strategy;

/**
 * Created by PhpStorm.
 * User: windownet
 * Date: 21/03/2016
 * Time: 10:42
 */

use Doctrine\ORM\Mapping;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Repository;
use Doctrine\ORM\EntityManager;
use CentraleLille\ReservationBundle\Entity\Booking\Event;
use CentraleLille\ReservationBundle\Entity\Booking\Strategy\IBooking;
use CentraleLille\ReservationBundle\Entity\Bookables\Bookable;
use CentraleLille\CustomFosUserBundle\Entity\Project;
use CentraleLille\CustomFosUserBundle\Entity\User;
use Symfony\Component\Validator\Constraints\DateTime;

abstract class BookStrategy implements IBooking
{
    protected $repository;
    protected $em;

    public function book(User $user, Project $project, DateTime $start, DateTime $end, Bookable $bookable)
    {
    }

    public function release(Event $event)
    {
    }

    public function isAvailableForPeriod($item, \DateTime $start, \DateTime $end, $repository)
    {
        $qb = $repository->createQueryBuilder('b');
        $query = $qb->select('b.id')
            ->where('b.startDateTime <= :startDateTime AND b.endDateTime >= :endDateTime')
            ->orWhere('b.startDateTime >= :startDateTime AND b.endDateTime <= :endDateTime')
            ->orWhere(
                'b.startDateTime >= :startDateTime
                AND b.endDateTime >= :endDateTime
                AND b.startDateTime <= :endDateTime'
            )
            ->orWhere(
                'b.startDateTime <= :startDateTime
                AND b.endDateTime <= :endDateTime
                AND b.endDateTime >= :startDateTime'
            )
            ->andWhere('b.bookable = :bookable')
            ->setParameters(array(
                'startDateTime'=> $start,
                'endDateTime'  => $end,
                'bookable' => $item,
            ))
        ;

        $results = $query->getQuery()->getResult();
        return count($results) === 0;
    }
}
