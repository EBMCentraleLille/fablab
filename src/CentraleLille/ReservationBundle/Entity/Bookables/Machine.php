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
namespace CentraleLille\ReservationBundle\Entity\Bookables;

use CentraleLille\ReservationBundle\Entity\Bookables\Type;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use CentraleLille\ReservationBundle\Entity\Bookables\Bookable;

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
 *
 * @ORM\Entity(repositoryClass="CentraleLille\ReservationBundle\Repository\MachineRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Machine extends Bookable
{

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
     *
     * @ORM\ManyToOne(targetEntity="Type",cascade={"persist","remove"})
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     */
    protected $type;

    /**
     * @ORM\Column(name="Statut", columnDefinition="ENUM('Disponible','Indisponible','Hors Service','En Test')")
     */
    protected $statut;

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

    /**
     * @return mixed
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * @param mixed $statut
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }
}
