<?php
/**
 * LoadCategoriesData.php File Doc
 *
 * Fixtures chargeant des données de categories
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
use CentraleLille\NewsFeedBundle\Entity\Category;

/**
 * LoadCategoriesData Class Doc
 *
 * Classe des Fixtures chargeant des données de categories
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
class LoadCategoriesData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * fonction chargeants les données de categories
     * @param  ObjectManager $manager
     *
     * @return void
     */
    public function load(ObjectManager $manager)
    {
        $category1 = new Category();
        $category2 = new Category();
        $category3 = new Category();
        $category4 = new Category();
        $category5 = new Category();
        $category6 = new Category();
        $category7 = new Category();
        $category8 = new Category();
        $category9 = new Category();

        $category1->setName('Mecanique');
        $category1->addProjet($this->getReference('projet-martin'));
        $category1->addProjet($this->getReference('projet-charles'));
        $category1->addProjet($this->getReference('projet-gregoire'));

        $category2->setName('Impression 3D');
        $category2->addProjet($this->getReference('projet-martin'));
        $category2->addProjet($this->getReference('projet-gregoire'));

        $category3->setName('Electronique');
        $category3->addProjet($this->getReference('projet-martin'));
        $category3->addProjet($this->getReference('projet-charles'));

        $category4->setName('Informatique');
        $category4->addProjet($this->getReference('projet-charles'));
        $category4->addProjet($this->getReference('projet-gregoire'));

        $category5->setName('CAO');
        $category5->addProjet($this->getReference('projet-martin'));

        $category6->setName('Découpeuse Laser');
        $category6->addProjet($this->getReference('projet-charles'));

        $category7->setName('Arduino');
        $category7->addProjet($this->getReference('projet-gregoire'));

        $category8->setName('Rasberry Pi');
        $category9->setName('Soudure');

        $manager->persist($category1);
        $manager->persist($category2);
        $manager->persist($category3);
        $manager->persist($category4);
        $manager->persist($category5);
        $manager->persist($category6);
        $manager->persist($category7);
        $manager->persist($category8);
        $manager->persist($category9);
        $manager->flush();

        $this->addReference('category-meca', $category1);
        $this->addReference('category-3D', $category2);
        $this->addReference('category-elec', $category3);
        $this->addReference('category-info', $category4);
        $this->addReference('category-cao', $category5);
        $this->addReference('category-laser', $category6);
        $this->addReference('category-ardu', $category7);
        $this->addReference('category-rasb', $category8);
        $this->addReference('category-soud', $category9);
    }
    /**
     * Attribue un ordre d'exécution aux fixtures
     *
     * @return integer Numéro d'exécution
     */
    public function getOrder()
    {
        return 3;
    }
}
