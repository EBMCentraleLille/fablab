<?php
/**
 * Created by PhpStorm.
 * User: windownet
 * Date: 14/03/2016
 * Time: 09:31
 */

namespace CentraleLille\ReservationBundle\Entity\Bookables;

use Doctrine\ORM\Mapping as ORM;

/**
 * Event
 *
 * @ORM\Table(name="type")
 * @ORM\Entity(repositoryClass="CentraleLille\ReservationBundle\Repository\TypeRepository")
 */
class Type
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $type_id;

    /**
     * @ORM\Column(name="TypeName", type="string", length=64)
     */
    protected $name;

    /**
     * @ORM\Column(name="Description", type="string", length=255,unique=true)
     */
    protected $description;

    /**
     * Type constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return mixed
     */

    public function getEventId()
    {
        return $this->type_id;
    }

    /**
     * @param mixed $event_id
     */
    public function setEventId($type_id)
    {
        $this->type_id = $type_id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
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
}
