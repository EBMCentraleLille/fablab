<?php
/**
 * NewsFeedController.php File Doc
 *
 * Controller permettant le chargement du fil d'actualité d'un user
 * sur la route /news-feed
 *
 * PHP Version 5.6
 *
 * @category   File
 * @package    CentraleLille:NewsFeedBundle
 * @subpackage Controller
 * @author     Lechaptois Martin <martin.lechaptois@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link       https://github.com/EBMCentraleLille/fablab
 */

namespace CentraleLille\NewsFeedBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * NewsFeedController Class Doc
 *
 * Controller de chargement du newsfeed
 *
 * @category   Controller
 * @package    CentraleLille:NewsFeedBundle
 * @subpackage Controller
 * @author     Lechaptois Martin <martin.lechaptois@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link       https://github.com/EBMCentraleLille/fablab
 */
class NewsFeedController extends Controller
{
    /**
    * IndexAction Function Doc
    *
    * Fonction qui charge les premières actualités d'un utilisateurs en fonction de ses abonnements
    *
    * @return Twig
    */
    public function indexAction()
    {
         //Récupération des dernières actualités
        $activityService=$this->container->get('fablab_newsfeed.activities');
        $recentActivities=$activityService->getActivities(30);

        return $this->render(
            'CentraleLilleNewsFeedBundle::newsFeed.html.twig',
            [
                'recentActivities' => $recentActivities
            ]
        );
    }
}
