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

namespace CentraleLille\ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Entity Class Doc
 *
 * Classe permettant la réservation de machine
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
    protected $title;

    /**
     *
     * @var                         datetime $creationDateTime
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
     * @var
     * @ORM\ManyToOne(targetEntity="Machine", cascade={"persist","remove"})
     */
    protected $machine;

    /**
     * Event constructor.
     *
     * @param int              $id
     * @param $creationDateTime
     * @param datetime         $startDateTime
     * @param datetime         $endDateTime
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
     * setCreationDateTime
     *
     * Assigne l'heure de créaton directement sans besoin de la définir
     *
     * @param datetime $creationDateTime
     */
    public function setCreationDateTime()
    {
        $date = date_create(date("d-M-Y H:i"));
        $this->creationDateTime = $date ;
    }
}
