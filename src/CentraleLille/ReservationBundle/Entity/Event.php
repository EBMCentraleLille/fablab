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

    /**
    protected $title;

    /**
     * @var datetime
     *
     * @ORM\Column(name="creationDateTime", type="datetime")
     */
    protected $creationDateTime;

    /**
     * @var datetime
     *
     * @ORM\Column(name="startDateTime", type="datetime")
     */
    protected $startDateTime;

    /**
     * @var datetime
     *
     * @ORM\Column(name="endDateTime", type="datetime")
     */
    protected $endDateTime;

    /**
     * @OneToOne()
     */
    protected $teamMember;

    /**
     * @var
     *
     * @ORM\Column(name="team", type="")
     */
    protected $team;

    /**
     * @var
     *
     * @ORM\Column(name="machine", type="machine")
     */
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

