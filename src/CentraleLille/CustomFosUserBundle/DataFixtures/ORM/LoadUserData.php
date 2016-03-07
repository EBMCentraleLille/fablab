<?php
/**
 * Created by PhpStorm.
 * User: mathieu
 * Date: 08/02/16
 * Time: 09:45
 */

namespace CustomFosUserBundle\DataFixtures\ORM;

use CentraleLille\CustomFosUserBundle\Entity\User;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUserData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $userAdmin = new User();
        $userAdmin->setUsername('admin');
        $userAdmin->setPlainPassword('admin');
        $userAdmin->setEmail('mathieu.chabas@gmail.com');
        $userAdmin->setFirstname('admin');
        $userAdmin->setLastname('admin');
        $userAdmin->setEnabled(true);

        $manager->persist($userAdmin);
        $manager->flush();
    }

    /*
     * The order in which fixtures will be loaded
     * The lower the number, the sooner that this fixture is loaded
     */
    public function getOrder()
    {
        return 1;
    }
}
