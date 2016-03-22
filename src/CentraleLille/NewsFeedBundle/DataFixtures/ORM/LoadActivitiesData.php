<?php
/**
 * LoadActivitiesData.php File Doc
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
use CentraleLille\NewsFeedBundle\Entity\Activity;

/**
 * LoadActivitiesData Class Doc
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
class LoadActivitiesData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * Fonction chargeants les données d'abonnements du user Martin
     *
     * @param ObjectManager $manager Manager de Fixtures
     *
     * @return void
     */
    public function load(ObjectManager $manager)
    {
        for ($counter = 1; $counter <= 30; $counter++) {
            ${"activity" . $counter} = new Activity();
        }
        $activity1 = new Activity();
        $activity2 = new Activity();
        $activity3 = new Activity();
        $activity4 = new Activity();
        $activity5 = new Activity();
        $activity6 = new Activity();
        $activity7 = new Activity();
        $activity8 = new Activity();
        $activity9 = new Activity();
        $activity10 = new Activity();
        $activity11 = new Activity();
        $activity12 = new Activity();
        $activity13 = new Activity();
        $activity14 = new Activity();
        $activity15 = new Activity();
        $activity16 = new Activity();
        $activity17 = new Activity();
        $activity18 = new Activity();
        $activity19 = new Activity();
        $activity20 = new Activity();
        $activity21 = new Activity();
        $activity22 = new Activity();
        $activity23 = new Activity();
        $activity24 = new Activity();
        $activity25 = new Activity();
        $activity26 = new Activity();
        $activity27 = new Activity();
        $activity28 = new Activity();
        $activity29 = new Activity();
        $activity30 = new Activity();

        $activity1->setProject($this->getReference('projet-martin'));
        $activity2->setProject($this->getReference('projet-martin'));
        $activity3->setProject($this->getReference('projet-martin'));
        $activity4->setProject($this->getReference('projet-martin'));
        $activity5->setProject($this->getReference('projet-martin'));
        $activity6->setProject($this->getReference('projet-martin'));
        $activity7->setProject($this->getReference('projet-martin'));
        $activity8->setProject($this->getReference('projet-martin'));
        $activity9->setProject($this->getReference('projet-martin'));
        $activity10->setProject($this->getReference('projet-martin'));
        $activity11->setProject($this->getReference('projet-charles'));
        $activity12->setProject($this->getReference('projet-charles'));
        $activity13->setProject($this->getReference('projet-charles'));
        $activity14->setProject($this->getReference('projet-charles'));
        $activity15->setProject($this->getReference('projet-charles'));
        $activity16->setProject($this->getReference('projet-charles'));
        $activity17->setProject($this->getReference('projet-charles'));
        $activity18->setProject($this->getReference('projet-charles'));
        $activity19->setProject($this->getReference('projet-charles'));
        $activity20->setProject($this->getReference('projet-charles'));
        $activity21->setProject($this->getReference('projet-gregoire'));
        $activity22->setProject($this->getReference('projet-gregoire'));
        $activity23->setProject($this->getReference('projet-gregoire'));
        $activity24->setProject($this->getReference('projet-gregoire'));
        $activity25->setProject($this->getReference('projet-gregoire'));
        $activity26->setProject($this->getReference('projet-gregoire'));
        $activity27->setProject($this->getReference('projet-gregoire'));
        $activity28->setProject($this->getReference('projet-gregoire'));
        $activity29->setProject($this->getReference('projet-gregoire'));
        $activity30->setProject($this->getReference('projet-gregoire'));

        $activity1->setUser($this->getReference('user-martin'));
        $activity2->setUser($this->getReference('user-martin'));
        $activity3->setUser($this->getReference('user-martin'));
        $activity4->setUser($this->getReference('user-martin'));
        $activity5->setUser($this->getReference('user-martin'));
        $activity6->setUser($this->getReference('user-martin'));
        $activity7->setUser($this->getReference('user-martin'));
        $activity8->setUser($this->getReference('user-martin'));
        $activity9->setUser($this->getReference('user-martin'));
        $activity10->setUser($this->getReference('user-martin'));
        $activity11->setUser($this->getReference('user-charles'));
        $activity12->setUser($this->getReference('user-charles'));
        $activity13->setUser($this->getReference('user-charles'));
        $activity14->setUser($this->getReference('user-charles'));
        $activity15->setUser($this->getReference('user-charles'));
        $activity16->setUser($this->getReference('user-charles'));
        $activity17->setUser($this->getReference('user-charles'));
        $activity18->setUser($this->getReference('user-charles'));
        $activity19->setUser($this->getReference('user-charles'));
        $activity20->setUser($this->getReference('user-charles'));
        $activity21->setUser($this->getReference('user-gregoire'));
        $activity22->setUser($this->getReference('user-gregoire'));
        $activity23->setUser($this->getReference('user-gregoire'));
        $activity24->setUser($this->getReference('user-gregoire'));
        $activity25->setUser($this->getReference('user-gregoire'));
        $activity26->setUser($this->getReference('user-gregoire'));
        $activity27->setUser($this->getReference('user-gregoire'));
        $activity28->setUser($this->getReference('user-gregoire'));
        $activity29->setUser($this->getReference('user-gregoire'));
        $activity30->setUser($this->getReference('user-gregoire'));

        $activity1->setContent("Martin a créé le projet projet-martin");
        $activity2->setContent('Martin a mis à jour le projet projet-martin');
        $activity3->setContent('Martin a mis à jour le projet projet-martin');
        $activity4->setContent('Martin a mis à jour le projet projet-martin');
        $activity5->setContent('Martin a mis à jour le projet projet-martin');
        $activity6->setContent('Martin a mis à jour le projet projet-martin');
        $activity7->setContent('Martin a mis à jour le projet projet-martin');
        $activity8->setContent('Martin a mis à jour le projet projet-martin');
        $activity9->setContent('Martin a mis à jour le projet projet-martin');
        $activity10->setContent('Charles a créé le projet projet-charles');
        $activity11->setContent('Charles a mis à jour le projet projet-charles');
        $activity12->setContent('Charles a mis à jour le projet projet-charles');
        $activity13->setContent('Charles a mis à jour le projet projet-charles');
        $activity14->setContent('Charles a mis à jour le projet projet-charles');
        $activity15->setContent('Charles a mis à jour le projet projet-charles');
        $activity16->setContent('Charles a mis à jour le projet projet-charles');
        $activity17->setContent('Charles a mis à jour le projet projet-charles');
        $activity18->setContent('Charles a mis à jour le projet projet-charles');
        $activity19->setContent('Charles a mis à jour le projet projet-charles');
        $activity20->setContent('Grégoire a créé le projet projet-gregoire');
        $activity21->setContent('Gregoire a mis à jour le projet projet-gregoire');
        $activity22->setContent('Gregoire a mis à jour le projet projet-gregoire');
        $activity23->setContent('Gregoire a mis à jour le projet projet-gregoire');
        $activity24->setContent('Gregoire a mis à jour le projet projet-gregoire');
        $activity25->setContent('Gregoire a mis à jour le projet projet-gregoire');
        $activity26->setContent('Gregoire a mis à jour le projet projet-gregoire');
        $activity27->setContent('Gregoire a mis à jour le projet projet-gregoire');
        $activity28->setContent('Gregoire a mis à jour le projet projet-gregoire');
        $activity29->setContent('Gregoire a mis à jour le projet projet-gregoire');
        $activity30->setContent('Gregoire a mis à jour le projet projet-gregoire');

        $activity1->setType('creation');
        $activity2->setType('update');
        $activity3->setType('update');
        $activity4->setType('update');
        $activity5->setType('update');
        $activity6->setType('update');
        $activity7->setType('update');
        $activity8->setType('update');
        $activity9->setType('update');
        $activity10->setType('update');
        $activity11->setType('creation');
        $activity12->setType('update');
        $activity13->setType('update');
        $activity14->setType('update');
        $activity15->setType('update');
        $activity16->setType('update');
        $activity17->setType('update');
        $activity18->setType('update');
        $activity19->setType('update');
        $activity20->setType('update');
        $activity21->setType('creation');
        $activity22->setType('update');
        $activity23->setType('update');
        $activity24->setType('update');
        $activity25->setType('update');
        $activity26->setType('update');
        $activity27->setType('update');
        $activity28->setType('update');
        $activity29->setType('update');
        $activity30->setType('update');

        $activity1->setDate(new \Datetime());
        $activity2->setDate(new \Datetime());
        $activity3->setDate(new \Datetime());
        $activity4->setDate(new \Datetime());
        $activity5->setDate(new \Datetime());
        $activity6->setDate(new \Datetime());
        $activity7->setDate(new \Datetime());
        $activity8->setDate(new \Datetime());
        $activity9->setDate(new \Datetime());
        $activity10->setDate(new \Datetime());
        $activity11->setDate(new \Datetime());
        $activity12->setDate(new \Datetime());
        $activity13->setDate(new \Datetime());
        $activity14->setDate(new \Datetime());
        $activity15->setDate(new \Datetime());
        $activity16->setDate(new \Datetime());
        $activity17->setDate(new \Datetime());
        $activity18->setDate(new \Datetime());
        $activity19->setDate(new \Datetime());
        $activity20->setDate(new \Datetime());
        $activity21->setDate(new \Datetime());
        $activity22->setDate(new \Datetime());
        $activity23->setDate(new \Datetime());
        $activity24->setDate(new \Datetime());
        $activity25->setDate(new \Datetime());
        $activity26->setDate(new \Datetime());
        $activity27->setDate(new \Datetime());
        $activity28->setDate(new \Datetime());
        $activity29->setDate(new \Datetime());
        $activity30->setDate(new \Datetime());

        for ($counter = 1; $counter <= 30; $counter+=3) {
            $activity = ${"activity" . $counter};
            $manager->persist($activity);
        }
        for ($counter = 2; $counter <= 30; $counter+=3) {
            $activity = ${"activity" . $counter};
            $manager->persist($activity);
        }
        for ($counter = 3; $counter <= 30; $counter+=3) {
            $activity = ${"activity" . $counter};
            $manager->persist($activity);
        }
        $manager->flush();
    }
    /**
     * Attribue un ordre d'exécution aux fixtures
     *
     * @return integer Numéro d'exécution
     */
    public function getOrder()
    {
        return 5;
    }
}
