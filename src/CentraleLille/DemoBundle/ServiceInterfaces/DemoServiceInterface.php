<?php
namespace CentraleLille\DemoBundle\ServiceInterfaces;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Demo Interface to explain how to define the service flow
 *
 * DO NOT USE
 */
interface DemoServiceInterface
{
    /**
     * Get the user from the context
     *
     * @return UserInterface
     */
    public function getUser();

    /**
     * Add a Role to the user
     * @param string $role
     * @return boolean
     */
    public function setRole($user, $role);
}