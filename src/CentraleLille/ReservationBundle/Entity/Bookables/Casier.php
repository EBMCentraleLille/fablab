<?php
/**
 * Created by PhpStorm.
 * User: windownet
 * Date: 17/03/2016
 * Time: 10:32
 */

namespace CentraleLille\ReservationBundle\Entity\Bookables;

use CentraleLille\ReservationBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Entity(repositoryClass="CentraleLille\ReservationBundle\Repository\MachineRepository")
 */

class Casier extends Bookable
{

}
