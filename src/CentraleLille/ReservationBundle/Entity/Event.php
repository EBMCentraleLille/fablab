<?php

namespace CentraleLille\ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @ORM\Column(name="teamMember",type="string",nullable=true)
     */
    protected $teamMember;

    /**
     * @var
     *
     * @ORM\Column(name="project", type="object",nullable=true)
     */
    protected $project;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="Machine", cascade={"persist"})
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
    public function __construct()
    {

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
    public function setCreationDateTime()
    {
        $date = date_create(date("d-M-Y H:i"));
        $this->creationDateTime = $date ;
    }


}

