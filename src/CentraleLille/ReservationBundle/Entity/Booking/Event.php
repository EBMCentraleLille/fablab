<?php
/**
 * PHP Version 5.5
 *
 * @Category Entity
 * @Package  Reservation
 * @author   Skikar El Mehdi <skikar.elmehdi@gmail.com>
 * @Licence  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @Link     https://github.com/pierloui/fablab
 */

namespace CentraleLille\ReservationBundle\Entity\Booking;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Entity Class Doc
 *
 * Classe permettant la réservation de Bookables
 *
 * @category Entity
 * @package  Reservation Bundle
 * @author   Skikar El Mehdi <skikar.elmehdi@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/pierloui/fablab
 */

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
     * @ORM\Column(type="string")
     */
    protected $description;

    /**
     * @ORM\Column(type="string")
     */
    protected $title;

    /**
     *
     * @var datetime $creationDateTime
     * @ORM\Column(type="datetime")
     */
    protected $creationDateTime;

    /**
     *
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
     * @return mixed
     */
    public function getBookable()
    {
        return $this->bookable;
    }

    /**
     * @param mixed $bookable
     */
    public function setBookable($bookable)
    {
        $this->bookable = $bookable;
    }

    /**
     * @ORM\ManyToOne(targetEntity="CentraleLille\ReservationBundle\Entity\Bookables\Bookable",
     *     cascade={"persist","remove"})
     *
     */
    protected $bookable;

    /**
     * @ORM\Column(name="status", type="string")
     */
    protected $status;

    /**
     * @ORM\ManyToOne(targetEntity="CentraleLille\CustomFosUserBundle\Entity\User", cascade={"persist","remove"})
     */
    protected $project;

    /**
     * @ORM\ManyToOne(targetEntity="CentraleLille\CustomFosUserBundle\Entity\Project", cascade={"persist","remove"})
     */
    protected $user;

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * @param mixed $project
     */
    public function setProject($project)
    {
        $this->project = $project;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }


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


    /**
     * @return DateTime
     */
    public function getEndDateTime()
    {
        return $this->endDateTime;
    }

    /**
     * @param DateTime $endDateTime
     */
    public function setEndDateTime($endDateTime)
    {
        $this->endDateTime = $endDateTime;
    }

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
     * setCreationDateTime
     *
     * Assigne l'heure de créaton directement sans besoin de la définir
     */
    public function setCreationDateTime()
    {
        $this->creationDateTime = new \DateTime() ;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }
}
