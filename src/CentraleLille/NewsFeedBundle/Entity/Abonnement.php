<?php

namespace CentraleLille\NewsFeedBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Abonnement
 *
 * @ORM\Table(name="abonnement")
 * @ORM\Entity(repositoryClass="CentraleLille\NewsFeedBundle\Repository\AbonnementRepository")
 */
class Abonnement
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
     * @var string
     *
     * @ORM\Column(name="User", type="string", length=255)
     */
    private $user;

    /**
    * @ORM\ManyToMany (targetEntity="CentraleLille\NewsFeedBundle\Entity\Category"), cascade={"persist"})
    **/
    private $categories;

    /**
    * @ORM\ManyToMany (targetEntity="CentraleLille\DemoBundle\Entity\Projet"), cascade={"persist"})
    **/
    private $projects;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set user
     *
     * @param string $user
     *
     * @return Abonnement
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set categories
     *
     * @param string $categories
     *
     * @return Abonnement
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * Get categories
     *
     * @return string
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Set projects
     *
     * @param string $projects
     *
     * @return Abonnement
     */
    public function setProjects($projects)
    {
        $this->projects = $projects;

        return $this;
    }

    /**
     * Get projects
     *
     * @return string
     */
    public function getProjects()
    {
        return $this->projects;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
        $this->projects = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add category
     *
     * @param \CentraleLille\NewsFeedBundle\Entity\Category $category
     *
     * @return Abonnement
     */
    public function addCategory(\CentraleLille\NewsFeedBundle\Entity\Category $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \CentraleLille\NewsFeedBundle\Entity\Category $category
     */
    public function removeCategory(\CentraleLille\NewsFeedBundle\Entity\Category $category)
    {
        $this->categories->removeElement($category);
    }

    /**
     * Add project
     *
     * @param \CentraleLille\DemoBundle\Entity\Projet $project
     *
     * @return Abonnement
     */
    public function addProject(\CentraleLille\DemoBundle\Entity\Projet $project)
    {
        $this->projects[] = $project;

        return $this;
    }

    /**
     * Remove project
     *
     * @param \CentraleLille\DemoBundle\Entity\Projet $project
     */
    public function removeProject(\CentraleLille\DemoBundle\Entity\Projet $project)
    {
        $this->projects->removeElement($project);
    }
}
