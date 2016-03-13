<?php
/**
 * LoadAbonnementsData.php File Doc
 *
 * Fixtures chargeant des données d'abonnements
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
use CentraleLille\NewsFeedBundle\Entity\Abonnement;

/**
 * LoadAbonnementsData Class Doc
 *
 * Classe des Fixtures chargeant des données d'abonnements
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
class LoadAbonnementsData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * Fonction chargeants les données d'abonnements
     *
     * @param ObjectManager $manager Manager de Fixtures
     *
     * @return void
     */
    public function load(ObjectManager $manager)
    {
        $abonnement1 = new Abonnement();
        $abonnement2 = new Abonnement();
        $abonnement3 = new Abonnement();

        $abonnement1->setUser($this->getReference('user-martin'));
        $abonnement1->addCategory($this->getReference('category-meca'));
        $abonnement1->addCategory($this->getReference('category-ardu'));
        $abonnement1->addCategory($this->getReference('category-cao'));
        $abonnement1->addProject($this->getReference('projet-charles'));
        $abonnement1->addProject($this->getReference('projet-gregoire'));

        $abonnement2->setUser($this->getReference('user-charles'));
        $abonnement2->addCategory($this->getReference('category-meca'));
        $abonnement2->addCategory($this->getReference('category-ardu'));
        $abonnement2->addCategory($this->getReference('category-cao'));
        $abonnement2->addProject($this->getReference('projet-martin'));
        $abonnement2->addProject($this->getReference('projet-gregoire'));

        $abonnement3->setUser($this->getReference('user-gregoire'));
        $abonnement3->addCategory($this->getReference('category-laser'));
        $abonnement3->addCategory($this->getReference('category-info'));
        $abonnement3->addCategory($this->getReference('category-soud'));
        $abonnement3->addProject($this->getReference('projet-charles'));
        $abonnement3->addProject($this->getReference('projet-martin'));

        $manager->persist($abonnement1);
        $manager->persist($abonnement2);
        $manager->persist($abonnement3);
        $manager->flush();
    }
    /**
     * Attribue un ordre d'exécution aux fixtures
     *
     * @return integer Numéro d'exécution
     */
    public function getOrder()
    {
        return 4;
    }
}
