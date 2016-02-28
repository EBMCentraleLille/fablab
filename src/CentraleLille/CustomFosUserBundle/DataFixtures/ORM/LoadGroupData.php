<?php
/**
 * Created by PhpStorm.
 * User: mathieu
 * Date: 28/02/16
 * Time: 16:26
 */

namespace CustomFosUserBundle\DataFixtures\ORM;

use CentraleLille\CustomFosUserBundle\Entity\Project;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadGroupData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $project = new Project('Project1');
        $project->setRoles(array());
        $project->addRole('ROLE_MEMBER');
        $this->getReference('user1')->addGroup($project);
        $this->getReference('user2')->addGroup($project);
        $manager->persist($project);

        $project = new Project('Project2');
        $project->setRoles(array());
        $project->addRole('ROLE_MEMBER');
        $this->getReference('user3')->addGroup($project);
        $this->getReference('user1')->addGroup($project);
        $manager->persist($project);
        $manager->flush();
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
