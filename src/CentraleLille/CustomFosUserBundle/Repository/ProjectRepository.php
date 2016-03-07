<?php

/**
 * Created by PhpStorm.
 * User: mathieu
 * Date: 27/02/16
 * Time: 16:13
 */

namespace CentraleLille\CustomFosUserBundle\Repository;

use Doctrine\ORM\EntityRepository;
use CentraleLille\CustomFosUserBundle\Entity\ProjectUser;

class ProjectRepository extends \Doctrine\ORM\EntityRepository
{

    public function addUserToProject($user, $project)
    {
        if(!$user->hasProject($project->getName())) {
            $manager = $this->getEntityManager();
            $projectUser = new ProjectUser();
            $projectUser->setProject($project);
            $projectUser->setUser($user);
            $manager->persist($projectUser);
            $manager->flush();
        }
    }

    public function removeUserFromProject($user, $project)
    {
        $manager = $this->getEntityManager();

        foreach ($user->getProjectUsers() as $projectUser) {
            if ($projectUser->getProject() === $project) {
                $manager->remove($projectUser);
                $manager->flush();
                break;
            }
        }
    }
}
