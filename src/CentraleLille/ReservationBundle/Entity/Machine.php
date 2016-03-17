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
use FOS\ElasticaBundle\Configuration\Search;

/**
 * Entity Class Doc
 *
 * Classe permettant la création de machines
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
 * @ORM\Table(name="machine")
 * @ORM\Entity(repositoryClass="CentraleLille\ReservationBundle\Repository\MachineRepository")
 * @Search(repositoryClass="CentraleLille\SearchBundle\Entity\SearchRepository\SearchRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Machine
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
     * @ORM\Column(name="machineName", type="string", length=255)
     */

    protected $machineName;

    /**
     * @var description
     * @ORM\Column(name="description",type="string")
     */
    protected $description;
    /**
     * Temps d'utilisation avant la dernière maintenance
     *
     * @ORM\Column(name="usedTime",type="date",nullable=true)
     */
    protected $usedTime;
    /**
     * @ORM\Column(name="lastMaintenance", type="date",nullable=true)
     */
    protected $lastMaintenance;
    /**
     * @ORM\Column(name="Requirements",type="string",nullable=true)
     */
    // Pour l'instant on garde en attendant de récupérer la classe Compétence
    protected $requirements;

    /**
     * @ORM\Column(name="Type",type="string",nullable=true)
     */
    protected $type;
    /**
     * Machine constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getMachineName()
    {
        return $this->machineName;
    }

    /**
     * @param mixed $machineName
     */
    public function setMachineName($machineName)
    {
        $this->machineName = $machineName;
    }

    /**
     * @return description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param description $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }


    /**
     * @return mixed
     */
    public function getUsedTime()
    {
        return $this->usedTime;
    }

    /**
     * @param mixed $usedTime
     */
    public function setUsedTime($usedTime)
    {
        $this->usedTime = $usedTime;
    }

    /**
     * @return mixed
     */
    public function getLastMaintenance()
    {
        return $this->lastMaintenance;
    }

    /**
     * @param mixed $lastMaintenance
     */
    public function setLastMaintenance($lastMaintenance)
    {
        $this->lastMaintenance = $lastMaintenance;
    }

    /**
     * @return mixed
     */
    public function getRequirements()
    {
        return $this->requirements;
    }

    public function __toString()
    {
        return (string)$this->getMachineName()."  ".$this->getDescription();
    }

    /**
     * @param mixed $requirements
     */
    public function setRequirements($requirements)
    {
        $this->requirements = $requirements;
    }
}
