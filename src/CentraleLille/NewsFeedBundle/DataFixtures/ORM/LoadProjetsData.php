<?php
/**
 * LoadProjetsData.php File Doc
 *
 * Fixtures chargeant des données de projets
 *
 * PHP Version 5.6
 *
 * @category   File
 * @package    CentraleLille:NewsFeedBundle
 * @subpackage DataFixtures
 * @author     Lechaptois Martin <martin.lechaptois@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link       https://github.com/EBMCentraleLille/fablab
 */

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CentraleLille\CustomFosUserBundle\Entity\Project;

/**
 * LoadProjetsData Class Doc
 *
 * Classe des Fixtures chargeant des données de projet
 *
 * PHP Version 5.6
 *
 * @category   Class
 * @package    CentraleLille:NewsFeedBundle
 * @subpackage DataFixtures
 * @author     Lechaptois Martin <martin.lechaptois@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link       https://github.com/EBMCentraleLille/fablab
 */
class LoadProjetsData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * Fonction chargeants les données de projets
     *
     * @param ObjectManager $manager Manager de Fixtures
     *
     * @return void
     */
    public function load(ObjectManager $manager)
    {
        $projet1 = new Project();
        $projet2 = new Project();
        $projet3 = new Project();
        $projet1->setName('projet de martin');
        $projet2->setName('projet de charles');
        $projet3->setName('projet de gregoire');
        $projet1->setPicture('http://thingiverse-production-new.s3.amazonaws.com/renders/81/3a/fe/1b/67/s105_preview_featured.jpg');
        $projet2->setPicture('http://thingiverse-production-new.s3.amazonaws.com/renders/8d/14/ce/a2/af/d7cd591717d65159d228d939146d31b4_preview_featured.JPG');
        $projet3->setPicture('https://thingiverse-production-new.s3.amazonaws.com/renders/f4/3f/0a/ce/2b/3dc783ba406af2c3a1a9ae087654c83f_preview_featured.jpg');

        $manager->persist($projet1);
        $manager->persist($projet2);
        $manager->persist($projet3);
        $manager->flush();

        $this->addReference('projet-martin', $projet1);
        $this->addReference('projet-charles', $projet2);
        $this->addReference('projet-gregoire', $projet3);
    }
    /**
     * Attribue un ordre d'exécution aux fixtures
     *
     * @return integer Numéro d'exécution
     */
    public function getOrder()
    {
        return 2;
    }
}
