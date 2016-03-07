<?php
<<<<<<< 71872a2e747cf024ae6cc231eed8b83ca3bc85b1
/**
 * DemoService File Doc Comment
 *
 * PHP Version 5.5
 *
 * @category DemoService
 * @package  DemoService
 * @author   Display Name <example@example.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/EBMCentraleLille/fablab
 */
=======

>>>>>>> Fix
namespace CentraleLille\DemoBundle\Service;

use CentraleLille\DemoBundle\ServiceInterfaces\DemoServiceInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\User\UserInterface;

<<<<<<< 71872a2e747cf024ae6cc231eed8b83ca3bc85b1
/**
 * DemoService Class Doc Comment
 *
 * @category DemoService
 * @package  DemoService
 * @author   Display Name <example@example.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/EBMCentraleLille/fablab
 */
=======
>>>>>>> Fix
class DemoService implements DemoServiceInterface
{

    private $tokenStorage;
    <<<<<<< 71872a2e747cf024ae6cc231eed8b83ca3bc85b1
    /**
     * Construct
     *
     * Description
     *
     * @param TokenStorageInterface $_tokenStorage token storage
     *
     * @return
     */
    public function __construct(TokenStorageInterface $_tokenStorage)
    {
        $this->tokenStorage = $_tokenStorage;
    }

    /**
     * Get User
     *
=======

    function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    /**
>>>>>>> Fix
     * Get the user from the context
     *
     * @return UserInterface
     */
    public function getUser()
    {
        return $this->tokenStorage->getToken()->getUser();
    }

    /**
<<<<<<< 71872a2e747cf024ae6cc231eed8b83ca3bc85b1
     * Set Role
     *
     * Add a Role to the user
     *
     * @param  string $user User
     * @param  string $role Role
     *
=======
     * Add a Role to the user
     * @param  string $role
>>>>>>> Fix
     * @return boolean
     */
    public function setRole($user, $role)
    {
        $user->setRole($role);
        return false;
    }
}
