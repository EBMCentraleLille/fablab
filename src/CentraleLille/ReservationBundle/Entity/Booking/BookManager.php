<?php

namespace CentraleLille\ReservationBundle\Entity\Booking\Strategy;

use CentraleLille\ReservationBundle\Entity\Bookables\Bookable;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping as ORM;

/**
 * Created by PhpStorm.
 * User: windownet
 * Date: 16/03/2016
 * Time: 08:31
 */
class BookManager
{
    protected $BookStrategy;

    public function __construct(BookStrategy $bookStrategy)
    {
        $this->BookStrategy = $bookStrategy;
    }

    /**
     * @param $user
     * @param $project
     * @param $start
     * @param $end
     * @param $bookable
     */
    public function book($user, $project, $start, $end, $bookable)
    {
        $bookstrategy = $this->BookStrategy;

        $bookstrategy->book($user, $project, $start, $end, $bookable);
    }

    /**
     * @param $event
     */
    public function release($event)
    {
        $bookstrategy = $this->BookStrategy;

        $bookstrategy->release($event);
    }
}
