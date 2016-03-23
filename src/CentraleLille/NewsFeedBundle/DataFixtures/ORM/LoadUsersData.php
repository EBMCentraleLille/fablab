<?php
/**
 * LoadUsersData.php File Doc
 *
 * Fixtures chargeant des données de Users
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
use CentraleLille\CustomFosUserBundle\Entity\User;

/**
 * LoadUsersData Class Doc
 *
 * Classe des Fixtures chargeant des données de Users
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
class LoadUsersData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * Fonction chargeants les données de Users
     *
     * @param ObjectManager $manager Manager de Fixtures
     *
     * @return void
     */
    public function load(ObjectManager $manager)
    {
        $user1 = new User();
        $user2 = new User();
        $user3 = new User();
        
        $user1->setUsername('marlec');
        $user1->setPlainPassword('marlec');
        $user1->setEmail('martin.lechaptois@gmail.com');
        $user1->setFirstname('martin');
        $user1->setLastname('lechaptois');
        $user1->setEnabled(true);

        $user2->setUsername('charles');
        $user2->setPlainPassword('charles');
        $user2->setEmail('charles.charles@gmail.com');
        $user2->setFirstname('charles');
        $user2->setLastname('corbiere');
        $user2->setEnabled(true);

        $user3->setUsername('gregoire');
        $user3->setPlainPassword('gregoire');
        $user3->setEmail('gregoire.denis@gmail.com');
        $user3->setFirstname('gregoire');
        $user3->setLastname('denis');
        $user3->setEnabled(true);
        
        $manager->persist($user1);
        $manager->persist($user2);
        $manager->persist($user3);
        $manager->flush();

        $this->addReference('user-martin', $user1);
        $this->addReference('user-charles', $user2);
        $this->addReference('user-gregoire', $user3);
    }
    /**
     * Attribue un ordre d'exécution aux fixtures
     *
     * @return integer Numéro d'exécution
     */
    public function getOrder()
    {
        return 1;
    }
}
