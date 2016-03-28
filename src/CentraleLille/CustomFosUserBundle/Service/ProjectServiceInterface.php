<?php
/**
 * Created by PhpStorm.
 * User: A593079
 * Date: 21/03/2016
 * Time: 15:34
 */
namespace CentraleLille\CustomFosUserBundle\Service;

/**
 * Created by PhpStorm.
 * User: A593079
 * Date: 15/03/2016
 * Time: 13:27
 */
interface ProjectServiceInterface
{
    public function isAllowedLeader($user, $project);

    public function addUserToProject($user, $project);

    public function removeUserFromProject($user, $project);

    public function setUserToProjectLeader($user, $project);

    public function getUsersOfProject($project);
}
