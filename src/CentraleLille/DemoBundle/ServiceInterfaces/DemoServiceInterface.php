<?php
/**
 * DemoServiceInterface File Doc Comment
 *
 * PHP Version 5.5
 *
 * @category DemoServiceInterface
 * @package  DemoServiceInterface
 * @author   Display Name <example@example.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/EBMCentraleLille/fablab
 */
namespace CentraleLille\DemoBundle\ServiceInterfaces;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * DemoServiceInterface Class Doc Comment
 *
 * Demo Interface to explain how to define the service flow
 * DO NOT USE
 *
 * @category DemoServiceInterface
 * @package  DemoServiceInterface
 * @author   Display Name <example@example.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/EBMCentraleLille/fablab
 */
interface DemoServiceInterface
{
    /**
     * Get User
     *
     * Get the user from the context
     *
     * @return UserInterface
     */
    public function getUser();

    /**
     * Set Role
     *
     * Add a Role to the user
     *
     * @param string $user User
     * @param string $role Role
     *
     * @return boolean
     */
    public function setRole($user, $role);
}
