<?php
<<<<<<< 71872a2e747cf024ae6cc231eed8b83ca3bc85b1
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
=======
>>>>>>> Fix
namespace CentraleLille\DemoBundle\ServiceInterfaces;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;

/**
<<<<<<< 71872a2e747cf024ae6cc231eed8b83ca3bc85b1
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
=======
 * Demo Interface to explain how to define the service flow
 *
 * DO NOT USE
>>>>>>> Fix
 */
interface DemoServiceInterface
{
    /**
<<<<<<< 71872a2e747cf024ae6cc231eed8b83ca3bc85b1
     * Get User
     *
=======
>>>>>>> Fix
     * Get the user from the context
     *
     * @return UserInterface
     */
    public function getUser();

    /**
<<<<<<< 71872a2e747cf024ae6cc231eed8b83ca3bc85b1
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
=======
     * Add a Role to the user
     * @param string $role
     * @return boolean
     */
public function setRole($user, $role);
}
>>>>>>> Fix
