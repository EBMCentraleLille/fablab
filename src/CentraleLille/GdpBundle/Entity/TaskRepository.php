<?php


namespace CentraleLille\GdpBundle\Entity;

use Doctrine\ORM\EntityRepository;

class TaskRepository extends EntityRepository
{
    public function findFiveTasks()
    {
        $queryBuilder = $this->createQueryBuilder('t');

        //add condition to get only last five tasks

        return $queryBuilder
            ->getQuery()
            ->getResult()
            ;

    }
}
