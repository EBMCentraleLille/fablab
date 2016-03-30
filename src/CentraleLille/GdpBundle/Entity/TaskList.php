<?php

namespace CentraleLille\GdpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TaskList
 *
 * @ORM\Table(name="task_list")
 * @ORM\Entity(repositoryClass="CentraleLille\GdpBundle\Repository\TaskListRepository")
 */
class TaskList
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
     * @@ORM\OneToMany(targetEntity="Task", mappedBy="taskLists")
     */
    private $tasks;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="CentraleLille\CustomFosUserBundle\Entity\Project")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id")
     */
    private $project;

    public function __construct()
    {
        $this->tasks = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     *
     * @return TaskList
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
     * Get all tasks from list
     *
     * @return Task
     */
    public function getTasks()
    {
        return $this->tasks;
    }

    /**
     * Add a task to the task list
     * @param \CentraleLille\GdpBundle\Entity\User $task
     */
    public function addTask($task)
    {
        $this->tasks[] = $task;
    }

    /**
     *
     */
    public function removeTask($task)
    {
        $pos = array_search($task, $this->tasks);
        if ($pos) {
            $this->tasks= array_slice($this->tasks, $pos, 1);
        }

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
}
