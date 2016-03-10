<?php

namespace CentraleLille\HomepageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StarProject
 *
 * @ORM\Table(name="star_project")
 * @ORM\Entity(repositoryClass="CentraleLille\HomepageBundle\Repository\StarProjectRepository")
 */
class StarProject
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
     * @ORM\ManyToOne (targetEntity="CentraleLille\CustomFosUserBundle\Entity\Project"), cascade={"persist"})
     */
    private $project;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="string", length=255)
     */
    private $content;

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
     * Set project
     *
     * @param string $project
     *
     * @return StarProject
     */
    public function setProject($project)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return string
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return StarProject
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }
}
