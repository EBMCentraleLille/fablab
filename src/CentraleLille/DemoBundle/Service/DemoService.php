<?php

namespace CentraleLille\DemoBundle\Service;

use CentraleLille\DemoBundle\ServiceInterfaces\DemoServiceInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class DemoService implements DemoServiceInterface
{

    private $tokenStorage;

    function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * Get the user from the context
     *
     * @return UserInterface
     */
    public function getUser()
    {
        return $this->tokenStorage->getToken()->getUser();
    }

    /**
     * Add a Role to the user
     * @param string $role
     * @return boolean
     */
    public function setRole($user, $role)
    {
        $user->setRole($role);
        return false;
    }
}
