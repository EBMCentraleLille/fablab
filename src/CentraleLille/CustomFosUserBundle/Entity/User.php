<?php

namespace CentraleLille\CustomFosUserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="CentraleLille\CustomFosUserBundle\Repository\UserRepository")
 * @ORM\Table(name="fos_user")
 * @ORM\HasLifecycleCallbacks
 */

class User extends BaseUser implements ProjectableUserInterface
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(name="firstname", type="string", length=255, nullable=true)
     */
    protected $firstname;

    /**
     * @var string
     * @ORM\Column(name="lastname", type="string", length=255, nullable=true)
     */
    protected $lastname;


    /**
     * @var string
     * @ORM\Column(name="promo", type="string", length=10, nullable=true)
     */
    protected $promo;

    /**
     * @var string
     * @ORM\Column(name="phone", type="string", length=25, nullable=true)
     */
    protected $phone;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="CentraleLille\CustomFosUserBundle\Entity\ProjectUser", mappedBy="user")
     */
    protected $projectUsers;

    /**
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @return string
     */
    public function getPromo()
    {
        return $this->promo;
    }

    /**
     * @param string $promo
     */
    public function setPromo($promo)
    {
        $this->promo = $promo;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

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
     * Gets the user's projects.
     *
     * @return \Traversable
     */
    public function getProjectUsers()
    {
        return $this->projectUsers ?: $this->projectUsers = new ArrayCollection();
    }

    /**
     * Gets the name of the projects which include the user.
     *
     * @return array
     */
    public function getProjectNames()
    {
        $names = array();
        foreach ($this->getProjectUsers() as $projectUser) {
            $names[] = $projectUser->getProject()->getName();
        }

        return $names;
    }

    /**
     * Indicates whether the user belongs to the specified project or not.
     *
     * @param string $name Name of the project
     *
     * @return Boolean
     */
    public function hasProject($name)
    {
        return in_array($name, $this->getProjectNames());
    }

//    /**
//     * Add a project to the user projects.
//     *
//     * @param Project $project
//     *
//     * @return self
//     */
//    public function addProject($projectUser)
//    {
//        if (!$this->getProjects()->contains($projectUser)) {
//            $this->getProjects()->add($projectUser);
//        }
//
//        return $this;
//    }
//
//    /**
//     * Remove a project from the user projects.
//     *
//     * @param Project $project
//     *
//     * @return self
//     */
//    public function removeProject($projectUser)
//    {
//        if ($this->getProjects()->contains($projectUser)) {
//            $this->getProjects()->removeElement($projectUser);
//        }
//
//        return $this;
//    }

    public function hasRoleWithinProject($role, $project)
    {
        foreach ($this->getProjectUsers() as $projectUser) {
            if ($projectUser->getProject()->getId() === $project->getId()) {
                if ($projectUser->hasRole($role)) {
                    return true;
                }
            }
        }
        return false;
    }
}
