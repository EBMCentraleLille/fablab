<?php
/**
 * Created by PhpStorm.
 * User: mathieu
 * Date: 28/02/16
 * Time: 16:26
 */

namespace CustomFosUserBundle\DataFixtures\ORM;

use CentraleLille\CustomFosUserBundle\Entity\Project;
use CentraleLille\CustomFosUserBundle\Entity\ProjectRole;
use CentraleLille\CustomFosUserBundle\Entity\ProjectUser;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CentraleLille\CustomFosUserBundle\Repository;

class LoadGroupData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $role_manager = 'LEADER';

        $role = new ProjectRole();
        $role->setName($role_manager);
        $manager->persist($role);

        $project = new Project('Project1');
        $manager->persist($project);

        $projectUser = new ProjectUser();
        $projectUser->setProject($project);
        $projectUser->setUser($this->getReference('user1'));
        $projectUser->addRole($role);
        $manager->persist($projectUser);

        $projectUser = new ProjectUser();
        $projectUser->setProject($project);
        $projectUser->setUser($this->getReference('user2'));
        $manager->persist($projectUser);

        $project = new Project('Project2');
        $manager->persist($project);

        $projectUser = new ProjectUser();
        $projectUser->setProject($project);
        $projectUser->setUser($this->getReference('user3'));
        $manager->persist($projectUser);

        $projectUser = new ProjectUser();
        $projectUser->setProject($project);
        $projectUser->setUser($this->getReference('user4'));
        $manager->persist($projectUser);

        $manager->flush();

        $repo = $manager->getRepository('CustomFosUserBundle:Project');
        $repo->addUserToProject($this->getReference('user1'), $manager->getRepository('CustomFosUserBundle:Project')->findOneByName('Project2'));
    }

    /*
     * The order in which fixtures will be loaded
     * The lower the number, the sooner that this fixture is loaded
     */
    public function getOrder()
    {
        return 2;
    }
}
