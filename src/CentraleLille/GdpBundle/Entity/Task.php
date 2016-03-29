<?php

namespace CentraleLille\GdpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use CentraleLille\GdpBundle\Enum\TaskStatus;

//use CentraleLille\CustomFosUserBundle\Entity\User as User;

/**
 * Task
 *
 * @ORM\Table(name="task")
 * @ORM\Entity(repositoryClass="CentraleLille\GdpBundle\Repository\TaskRepository")
 */
class Task
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="string", length=1024)
     */
    private $body;

    /**
     * @var bool
     *
     * @ORM\Column(name="status", type="string", length=255)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=255)
     */
    private $author;

    /**
     * @ORM\Column(name="createdDate", type="date")
     */
    private $createdDate;

    /**
     * @ORM\Column(name="endDate", type="date")
     */
    private $endDate;

    /**
     * @ORM\ManyToOne(targetEntity="CentraleLille\CustomFosUserBundle\Entity\User")
     * @ORM\JoinColumn(name="in_charge_user_id", referencedColumnName="id")
     */
    private $inChargeUser;


    /**
     * @ORM\ManyToOne(targetEntity="TaskList", inversedBy="tasks")
     * @ORM\JoinColumn(name="tasklist_id",referencedColumnName="id")
     */
    private $taskLists;


    /**
     * @ORM\ManyToOne(targetEntity="CentraleLille\CustomFosUserBundle\Entity\Project")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id")
     */
    private $project;


    public function __construct()
    {
        $this->createdDate = new \DateTime();
        $this->taskLists = new \Doctrine\Common\Collections\ArrayCollection();
        $this->status = TaskStatus::PLANIFIE;
    }

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
     * Set title
     *
     * @param string $title
     *
     * @return Task
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set body
     *
     * @param string $body
     *
     * @return Task
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set status
     *
     * @param boolean $status
     *
     * @return Task
     */
    public function setStatus($status)
    {
        if (TaskStatus::isValidValue($status)) {
            $this->status = $status;
        }

        return $this;
    }

    /**
     * Get status
     *
     * @return bool
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set author
     *
     * @param string $author
     *
     * @return Task
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set createdDate
     *
     * @param \DateTime $ate
     *
     * @return Task
     */
    public function setCreatedDate($date)
    {
        $this->createdDate = $date;

        return $this;
    }

    /**
     * Get createdDate
     *
     * @return \DateTime
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $date
     *
     * @return Task
     */
    public function setEndDate($date)
    {
        $this->endDate = $date;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->date;
    }

    /**
     * Set in charge user
     *
     * @param \CentraleLille\CustomerFosUserBundle\Entity\User
     *
     * @return Task
     */
    public function setInChargeUser($user)
    {
        $this->inChargeUser = $user;

        return $this;
    }

    /**
     * Get in charge user
     *
     * @return \CentraleLille\CustomerFosUserBundle\Entity\User
     */
    public function getInChargeUser()
    {
        return $this->inChargeUser;
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

    /**
     * @param mixed $taskList
     */
    public function setTaskList($taskList)
    {
        $this->taskLists = $taskList;
    }

    /**
     * @return \CentraleLille\GdpBundle\Entity\User
     */
    public function getTaskList()
    {
        return $this->taskLists;
    }
}
