<?php
class TaskService
{

    private $entityManager;

    /*
    * @param EntityManager $entityManager
    */
    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /*
    * @param integer $blogId
    *
    * @return Blog
    */
    public function getTaskById($taskId)
    {
        return $this->entityManager->getRepository('GdpBundle:Task')->find($taskId);
    }

}