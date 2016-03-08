<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 3/5/16
 * Time: 5:38 PM
 */

namespace CentraleLille\CustomFosUserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="CentraleLille\CustomFosUserBundle\Repository\ProjectUserRepository")
 * @ORM\Table(name="project_user")
 */
class ProjectUser
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="CentraleLille\CustomFosUserBundle\Entity\User", inversedBy="projectUsers")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="CentraleLille\CustomFosUserBundle\Entity\Project", inversedBy="projectUsers")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id")
     */
    protected $project;

    /**
     * @ORM\ManyToMany(targetEntity="CentraleLille\CustomFosUserBundle\Entity\ProjectRole")
     * @ORM\JoinTable(name="project_user_role",
     *      joinColumns={@ORM\JoinColumn(name="project_user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="project_role_id", referencedColumnName="id")}
     *      )
     */
    protected $roles;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = $id;
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

    public function getRoles()
    {
        return $this->roles ?: $this->roles = new ArrayCollection();
    }

    public function getRoleNames()
    {
        $names = array();
        foreach ($this->getRoles() as $role) {
            $names[] = $role->getName();
        }

        return $names;
    }

    public function addRole($projectRole)
    {
        if (!$this->getRoles()->contains($projectRole)) {
            $this->getRoles()->add($projectRole);
        }

        return $this;
    }

    public function hasRole($name)
    {
        return in_array($name, $this->getRoleNames());
    }

    public function removeRole($projectRole)
    {
        if ($this->getRoles()->contains($projectRole)) {
            $this->getRoles()->removeElement($projectRole);
        }

        return $this;
    }
}
