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
     * Fonction chargeants les données de categories
     *
     * @param ObjectManager $manager Manager de Fixtures
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
        $category1->addProject($this->getReference('projet-martin'));
        $category1->addProject($this->getReference('projet-charles'));
        $category1->addProject($this->getReference('projet-gregoire'));
        $category1->setPicture('http://formycar.fr/wp-content/uploads/2015/04/mecanique-voiture-pas-cher.png');

        $category2->setName('Impression 3D');
        $category2->addProject($this->getReference('projet-martin'));
        $category2->addProject($this->getReference('projet-gregoire'));
        $category2->setPicture(
            'http://www.metronews.fr/_internal/gxml!0/r0dc21o2f3vste5s7ezej9x3'
            .'a10rp3w$jf8ubqtwt541moqj1c66vgxo4bbj2a3/Replicator-21.jpeg'
        );

        $category3->setName('Electronique');
        $category3->addProject($this->getReference('projet-martin'));
        $category3->addProject($this->getReference('projet-charles'));
        $category3->setPicture(
            'http://industrie.meosix.fr/nfelec/wp-content/uploads/sites/'
            .'11/2014/10/composant-electronique.jpg'
        );

        $category4->setName('Informatique');
        $category4->addProject($this->getReference('projet-charles'));
        $category4->addProject($this->getReference('projet-gregoire'));
        $category4->setPicture(
            'http://ceryom.com/wp-content/uploads/2015/06/developpement-web-nancy'
            .'-concept-programmation-web-developpeur-web-agence-web-nancy-communication.png'
        );

        $category5->setName('CAO');
        $category5->addProject($this->getReference('projet-martin'));
        $category5->setPicture('http://img.directindustry.fr/images_di/photo-g/66484-2959335.jpg');

        $category6->setName('Découpeuse Laser');
        $category6->addProject($this->getReference('projet-charles'));
        $category6->setPicture('http://www.murblanc.org/ccsti/fablab/120228_0372.jpg');

        $category7->setName('Arduino');
        $category7->addProject($this->getReference('projet-gregoire'));
        $category7->setPicture('http://telefab.fr/wp-content/uploads/2013/02/ArduinoUno_r2_front450px.jpg');

        $category8->setName('Rasberry Pi');
        $category8->setPicture('https://wiki.openwrt.org/_media/media/raspberry_pi_foundation/rpi2b.jpg');
        
        $category9->setName('Soudure');
        $category9->setPicture('http://www.fetrot-industry.com/img/mecano/soudure-main.jpg');

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
