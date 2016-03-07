<?php
/**
 * Created by PhpStorm.
 * User: mathieu
 * Date: 08/02/16
 * Time: 09:45
 */

namespace CustomFosUserBundle\DataFixtures\ORM;

use CentraleLille\CustomFosUserBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // AdminUser
        $userAdmin = new User();
        $userAdmin->setUsername('admin');
        $userAdmin->setPlainPassword('admin');
        $userAdmin->setEmail('superadmin@gmail.com');
        $userAdmin->setFirstname('admin');
        $userAdmin->setLastname('admin');
        $userAdmin->setEnabled(true);
        $userAdmin->setRoles(array());
        $userAdmin->addRole('ROLE_ADMIN');
        $manager->persist($userAdmin);
        $this->addReference('admin', $userAdmin);

        // User1
        $user = new User();
        $user->setUsername('user1');
        $user->setPlainPassword('user1');
        $user->setEmail('user1@gmail.com');
        $user->setFirstname('user1');
        $user->setLastname('user1');
        $user->setEnabled(true);
        $manager->persist($user);
        $this->addReference('user1', $user);

        // User2
        $user = new User();
        $user->setUsername('user2');
        $user->setPlainPassword('user2');
        $user->setEmail('user2@gmail.com');
        $user->setFirstname('user2');
        $user->setLastname('user2');
        $user->setEnabled(true);
        $manager->persist($user);
        $this->addReference('user2', $user);

        // User3
        $user = new User();
        $user->setUsername('user3');
        $user->setPlainPassword('user3');
        $user->setEmail('user3@gmail.com');
        $user->setFirstname('user3');
        $user->setLastname('user3');
        $user->setEnabled(true);
        $manager->persist($user);
        $this->addReference('user3', $user);

        // User4
        $user = new User();
        $user->setUsername('user4');
        $user->setPlainPassword('user4');
        $user->setEmail('user4@gmail.com');
        $user->setFirstname('user4');
        $user->setLastname('user4');
        $user->setEnabled(true);
        $manager->persist($user);
        $this->addReference('user4', $user);

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
