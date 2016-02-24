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
     * @var datetime $creationDateTime
     * @ORM\Column(type="datetime")
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
     * @var teamMember
     *
     * @ORM\Column(name="teamMember",type="string")
     */
    protected $teamMember;

    /**
     * @var
     *
     * @ORM\Column(name="project", type="object")
     */
    protected $project;

    /**
     * @var
     *
     * @ORM\OneToOne(targetEntity="Machine", cascade={"persist"})
     */
    protected $machine;

    /**
     * Event constructor.
     * @param int $id
     * @param $creationDateTime
     * @param datetime $startDateTime
     * @param datetime $endDateTime
     * @param $teamMember
     * @param $team
     * @param $machine
     */
    public function __construct($id, datetime $startDateTime, datetime $endDateTime, $teamMember, $team, $machine)
    {
        $this->id = $id;
        $this->creationDateTime = date("d-m-Y H:i:s");
        $this->startDateTime = $startDateTime;
        $this->endDateTime = $endDateTime;
        $this->teamMember = $teamMember;
        $this->team = $team;
        $this->machine = $machine;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getMachine()
    {
        return $this->machine;
    }

    /**
     * @param mixed $machine
     */
    public function setMachine($machine)
    {
        $this->machine = $machine;
    }

    /**
     * @return mixed
     */
    public function getTeamMember()
    {
        return $this->teamMember;
    }

    /**
     * @param mixed $teamMember
     */
    public function setTeamMember($teamMember)
    {
        $this->teamMember = $teamMember;
    }

    /**
     * @return mixed
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * @param mixed $team
     */
    public function setTeam($team)
    {
        $this->team = $team;
    }

    /**
     * @return datetime
     */
    public function getEndDateTime()
    {
        return $this->endDateTime;
    }

    /**
     * @param datetime $endDateTime
     */
    public function setEndDateTime($endDateTime)
    {
        $this->endDateTime = $endDateTime;
    }

    /**
     * @return datetime
     */
    public function getStartDateTime()
    {
        return $this->startDateTime;
    }

    /**
     * @param datetime $startDateTime
     */
    public function setStartDateTime($startDateTime)
    {
        $this->startDateTime = $startDateTime;
    }

    /**
     * @return datetime
     */
    public function getCreationDateTime()
    {
        return $this->creationDateTime;
    }

    /**
     * @param datetime $creationDateTime
     */
    public function setCreationDateTime($creationDateTime)
    {
        $this->creationDateTime = $creationDateTime;
    }


}

