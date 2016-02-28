<?php
/**
 * Created by PhpStorm.
 * User: mathieu
 * Date: 27/02/16
 * Time: 15:35
 */

namespace CentraleLille\CustomFosUserBundle\Entity;

use FOS\UserBundle\Model\Group as BaseGroup;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="CentraleLille\CustomFosUserBundle\Repository\ProjectRepository")
 * @ORM\Table(name="fos_group")
 */
class Project extends BaseGroup
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
}
