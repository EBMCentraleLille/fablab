<?php

/**
 * Created by PhpStorm.
 * User: mathieu
 * Date: 27/02/16
 * Time: 16:13
 */

namespace CentraleLille\CustomFosUserBundle\Repository;

class ProjectRepository extends \Doctrine\ORM\EntityRepository
{

    public function createProject($name)
    {
        // TODO
    }

    public function findGroupByName($name)
    {
        // TODO
    }

    public function addUserToProject($user, $project)
    {
        // TODO
    }

    public function removeUserFromProject($user, $project)
    {
        // TODO
    }
}
