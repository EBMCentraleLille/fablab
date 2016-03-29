<?php

namespace CentraleLille\KnowledgeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserCompetence
 *
 * @ORM\Table(name="user_competence")
 * @ORM\Entity(repositoryClass="CentraleLille\KnowledgeBundle\Repository\UserCompetenceRepository")
 */
class UserCompetence
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
     * @var int
     *
     * @ORM\Column(name="level", type="integer")
     */
    private $level;

    /**
     * @ORM\ManyToOne(targetEntity="Competence")
     * @ORM\JoinColumn(name="competence_id", referencedColumnName="id")
     */
    private $competence;

    /**
     * @ORM\ManyToOne(targetEntity="\CentraleLille\CustomFosUserBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;


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
     * Set level
     *
     * @param integer $level
     *
     * @return UserCompetence
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return int
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Get competence
     *
     * @return Competence
     */
    public function getCompetence()
    {
        return $this->competence;
    }

    /**
     * Set competence
     *
     * @return Competence
     */
    public function setCompetence($competence)
    {
        $this->competence = $competence;
        return $this;
    }

    /**
     * Get user
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set user
     *
     * @return User
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }
}
