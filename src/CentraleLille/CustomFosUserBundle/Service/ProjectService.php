<?php

namespace CentraleLille\CustomFosUserBundle\Service;

use CentraleLille\CustomFosUserBundle\Entity\ProjectRole;
use CentraleLille\CustomFosUserBundle\Entity\ProjectUser;

/**
 * Created by PhpStorm.
 * User: A593079
 * Date: 15/03/2016
 * Time: 13:27
 */
class ProjectService
{
    protected $em;
    protected $authorizationChecker;

    public function __construct(\Doctrine\ORM\EntityManager $entityManager, \Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface $authorizationChecker) {
        $this->em = $entityManager;
        $this->authorizationChecker = $authorizationChecker;
    }

    public function isAllowedLeader($user, $project) {
        if ($user==null || $project==null) {
            return false;
        }
        if (true === $this->authorizationChecker->isGranted('ROLE_ADMIN')) {
            return true;
        }
        if ($user->hasRoleWithinProject(ProjectRole::PROJECT_ROLE_LEADER, $project)) {
            return true;
        }
        return false;
    }

    public function addUserToProject($user, $project)
    {
        if (!$user->hasProject($project->getName())) {
            $projectUser = new ProjectUser();
            $projectUser->setProject($project);
            $projectUser->setUser($user);
            $this->em->persist($projectUser);
            $this->em->flush();
        }
    }

    public function removeUserFromProject($user, $project)
    {

        foreach ($user->getProjectUsers() as $projectUser) {
            if ($projectUser->getProject() === $project) {
                $this->em->remove($projectUser);
                $this->em->flush();
                break;
            }
        }
    }

    public function setUserToProjectLeader($user, $project)
    {

        foreach ($user->getProjectUsers() as $projectUser) {
            if ($projectUser->getProject() === $project) {

                $role = $this->em->getRepository('CustomFosUserBundle:ProjectRole')
                    ->findOneBy(array("name" => ProjectRole::PROJECT_ROLE_LEADER));

                $projectUser->addRole($role);
                $this->em->flush();
                return true;
            }
        }
        return false;
    }

}