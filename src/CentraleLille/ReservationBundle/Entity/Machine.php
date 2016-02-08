<?php

namespace CentraleLille\ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Event
 *
 * @ORM\Table(name="event")
 * @ORM\Entity(repositoryClass="CentraleLille\ReservationBundle\Repository\EventRepository")
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
     * @ORM\Column(name="machineName", type="String", length="255")
     */

    protected $machineName;

    /**
     * @ORM\Column(name="usedTime",type="date")
     */
    protected $usedTime;
    /**
     * @ORM\Column(name="lastMaintenance", type="date")
     */
    protected $lastMaintenance;

    protected $requirements;

}

