<?php

namespace CentraleLille\ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Event
 *
 * @ORM\Table(name="event")
 * @ORM\Entity(repositoryClass="CentraleLille\ReservationBundle\Repository\EventRepository")
 */
class Event
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    protected $title;

    protected $creationDateTime;

    protected $startDateTime;

    protected $endDateTime;

    /**
     * @OneToOne()
     */
    protected $teamMember;

    protected $team;

    protected $machine;




    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}

