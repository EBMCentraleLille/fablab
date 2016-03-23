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
     * @return BookStrategy
     */
    public function getBookStrategy()
    {
        return $this->BookStrategy;
    }

    /**
     * @param BookStrategy $BookStrategy
     */
    public function setBookStrategy($BookStrategy)
    {
        $this->BookStrategy = $BookStrategy;
    }
}
