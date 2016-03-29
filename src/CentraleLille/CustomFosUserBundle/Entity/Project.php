<?php
/**
 * Created by PhpStorm.
 * User: mathieu
 * Date: 27/02/16
 * Time: 15:35
 */

namespace CentraleLille\CustomFosUserBundle\Entity;

use Doctrine\Common\Collections\Collection;
use FOS\UserBundle\Model\Group as BaseGroup;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="CentraleLille\CustomFosUserBundle\Repository\ProjectRepository")
 * @ORM\Table(name="project")
 */
class Project
{
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
     * @var date
     * @ORM\Column(name="dateBegin", type="date", nullable=true)
     */
    protected $dateBegin;

    /**
     * @var date
     * @ORM\Column(name="dateEnd", type="date", nullable=true)
     */
    protected $dateEnd;

    /**
     * @var string
     * @ORM\Column(name="dateUpdate", type="string", nullable=true)
     */
    protected $dateUpdate;

    /**
     * @var string
     * @ORM\Column(name="picture", type="string", length=2000, nullable=true)
     */
    protected $picture;

    /**
     * @var string
     * @ORM\Column(name="summary", type="string", length=500, nullable=true)
     */
    protected $summary;

    /**
     * @var string
     * @ORM\Column(name="description", type="string", nullable=true)
     */
    protected $description;
        


    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="CentraleLille\CustomFosUserBundle\Entity\ProjectUser", mappedBy="project")
     */
    protected $projectUsers;


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

    /**
     * Set dateBegin
     *
     * @param \DateTime $dateBegin
     *
     * @return Project
     */
    public function setDateBegin($dateBegin)
    {
        $this->dateBegin = $dateBegin;

        return $this;
    }

    /**
     * Get dateBegin
     *
     * @return \DateTime
     */
    public function getDateBegin()
    {
        return $this->dateBegin;
    }

    /**
     * Set dateEnd
     *
     * @param \DateTime $dateEnd
     *
     * @return Project
     */
    public function setDateEnd($dateEnd)
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    /**
     * Get dateEnd
     *
     * @return \DateTime
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * Add projectUser
     *
     * @param \CentraleLille\CustomFosUserBundle\Entity\ProjectUser $projectUser
     *
     * @return Project
     */
    public function addProjectUser(\CentraleLille\CustomFosUserBundle\Entity\ProjectUser $projectUser)
    {
        $this->projectUsers[] = $projectUser;

        return $this;
    }

    /**
     * Remove projectUser
     *
     * @param \CentraleLille\CustomFosUserBundle\Entity\ProjectUser $projectUser
     */
    public function removeProjectUser(\CentraleLille\CustomFosUserBundle\Entity\ProjectUser $projectUser)
    {
        $this->projectUsers->removeElement($projectUser);
    }

    /**
     * Get projectUsers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProjectUsers()
    {
        return $this->projectUsers;
    }

    /**
     * Set dateUpdate
     *
     * @param \DateTime $dateUpdate
     *
     * @return Project
     */
    public function setDateUpdate($dateUpdate)
    {
        $this->dateUpdate = $dateUpdate;

        return $this;
    }

    /**
     * Get dateUpdate
     *
     * @return \DateTime
     */
    public function getDateUpdate()
    {
        return $this->dateUpdate;
    }

    /**
     * Set picture
     *
     * @param string $picture
     *
     * @return Project
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return string
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set summary
     *
     * @param string $summary
     *
     * @return Project
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;

        return $this;
    }

    /**
     * Get summary
     *
     * @return string
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Project
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}
