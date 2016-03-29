<?php

namespace CentraleLille\CustomFosUserBundle\Service;

use CentraleLille\CustomFosUserBundle\Entity\ProjectRole;
use CentraleLille\CustomFosUserBundle\Entity\ProjectUser;
use Symfony\Bridge\Monolog\Logger;
use \Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * Created by PhpStorm.
 * User: A593079
 * Date: 15/03/2016
 * Time: 13:27
 */
class ProjectService implements ProjectServiceInterface
{
    protected $em;
    protected $authorizationChecker;
    protected $logger;

    public function __construct(
        \Doctrine\ORM\EntityManager $entityManager,
        AuthorizationCheckerInterface $authorizationChecker,
        Logger $logger
    ) {
        $this->em = $entityManager;
        $this->authorizationChecker = $authorizationChecker;
        $this->logger = $logger;
    }

    public function isAllowedLeader($user, $project)
    {
        if ($user == null || $project == null) {
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
            $this->logger->info('OK project added');
            return $projectUser;
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
        $this->logger->info('SetToProjectLeader');
        foreach ($user->getProjectUsers() as $projectUser) {
            $this->logger->info('Foreach projects');
            if ($projectUser->getProject() === $project) {
                $this->logger->info('Pushing role');
                $role = $this->em->getRepository('CustomFosUserBundle:ProjectRole')
                    ->findOneBy(array("name" => ProjectRole::PROJECT_ROLE_LEADER));

                $projectUser->addRole($role);
                $this->em->persist($projectUser);
                $this->em->flush();
                return true;
            }
        }
        return false;
    }

    public function setUserToProjectLeaderWithProjectUser($projectUser)
    {
        $role = $this->em->getRepository('CustomFosUserBundle:ProjectRole')
            ->findOneBy(array("name" => ProjectRole::PROJECT_ROLE_LEADER));
        $projectUser->addRole($role);
        $this->em->flush();
        return true;
    }

    public function getUsersOfProject($project)
    {
        $users = array();
        foreach ($project->getProjectUsers() as $projectUser) {
            $users[] = $projectUser->getUser();
        }
        return $users;
    }

    public function getProjectsOfUser($user)
    {
        $projects = array();
        foreach ($user->getProjectUsers() as $projectUser) {
            $projects[] = $projectUser->getProject();
        }
        return $projects;
    }
}
