<?php
/**
 * LoadStarProjectData.php File Doc
 *
 * Fixtures chargeant des données de projets "star"
 *
 * PHP Version 5.6
 *
 * @category   File
 * @package    CentraleLille:HomepageBundle
 * @subpackage DataFixtures
 * @author     Lechaptois Martin <martin.lechaptois@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link       https://github.com/EBMCentraleLille/fablab
 */

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CentraleLille\HomepageBundle\Entity\StarProject;

/**
 * LoadAbonnementsData Class Doc
 *
 * Classe des Fixtures chargeant des données de projets "star"
 *
 * PHP Version 5.6
 *
 * @category   Class
 * @package    CentraleLille:HomepageBundle
 * @subpackage DataFixtures
 * @author     Lechaptois Martin <martin.lechaptois@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link       https://github.com/EBMCentraleLille/fablab
 */
class LoadStarProjectData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * Fonction chargeants les données d'abonnements
     *
     * @param ObjectManager $manager manager de fixtures
     *
     * @return void
     */
    public function load(ObjectManager $manager)
    {
        $starProject1 = new StarProject();
        $starProject2 = new StarProject();
        $starProject3 = new StarProject();

        $starProject1->setProject($this->getReference('projet-martin'));
        $starProject2->setProject($this->getReference('projet-charles'));
        $starProject3->setProject($this->getReference('projet-gregoire'));

        $starProject1->setContent('ceci est le projet star n°1');
        $starProject2->setContent('ceci est le projet star n°2');
        $starProject3->setContent('ceci est le projet star n°3');

        $manager->persist($starProject1);
        $manager->persist($starProject2);
        $manager->persist($starProject3);
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
