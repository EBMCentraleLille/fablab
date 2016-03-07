<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 3/5/16
 * Time: 6:10 PM
 */

namespace CentraleLille\CustomFosUserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="CentraleLille\CustomFosUserBundle\Repository\ProjectRoleRepository")
 * @ORM\Table(name="project_role")
 */
class ProjectRole
{

    const project_role_member = 'PROJECT_MEMBER';
    const project_role_leader = 'PROJECT_LEADER';

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(name="name", type="string", length=40, nullable=false)
     */
    protected $name;

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

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}
