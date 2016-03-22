<?php
/**
 * Created by PhpStorm.
 * User: windownet
 * Date: 21/03/2016
 * Time: 09:32
 */

namespace CentraleLille\ReservationBundle\Entity\Booking\Strategy;

use CentraleLille\ReservationBundle\Entity\Bookables\Bookable;
use Symfony\Component\Validator\Constraints\DateTime;
use CentraleLille\CustomFosUserBundle\Entity\User;
use CentraleLille\CustomFosUserBundle\Entity\Project;
use CentraleLille\ReservationBundle\Entity\Booking\Event;

interface IBooking
{
    public function book(User $user, Project $project, DateTime $start, DateTime $end, Bookable $bookabl);

    public function release(Event $event);
}
