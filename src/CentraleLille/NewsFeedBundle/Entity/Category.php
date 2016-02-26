<?php

namespace CentraleLille\NewsFeedBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="CentraleLille\NewsFeedBundle\Repository\CategoryRepository")
 */
class Category
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
     * @ORM\Column(name="Name", type="string", length=255)
     */
    private $name;

    /**
    * @ORM\ManyToMany (targetEntity="CentraleLille\DemoBundle\Entity\Projet"), cascade={"persist"})
    **/
    private $projets;


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
     * Set name
     *
     * @param string $name
     *
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set projets
     *
     * @param string $projets
     *
     * @return Category
     */
    public function setProjets($projets)
    {
        $this->projets = $projets;

        return $this;
    }

    /**
     * Get projets
     *
     * @return string
     */
    public function getProjets()
    {
        return $this->projets;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->projets = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add projet
     *
     * @param \CentraleLille\DemoBundle\Entity\Projet $projet
     *
     * @return Category
     */
    public function addProjet(\CentraleLille\DemoBundle\Entity\Projet $projet)
    {
        $this->projets[] = $projet;

        return $this;
    }

    /**
     * Remove projet
     *
     * @param \CentraleLille\DemoBundle\Entity\Projet $projet
     */
    public function removeProjet(\CentraleLille\DemoBundle\Entity\Projet $projet)
    {
        $this->projets->removeElement($projet);
    }
}
