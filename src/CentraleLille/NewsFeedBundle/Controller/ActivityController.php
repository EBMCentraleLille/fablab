<?php
/**
 * ActivtityController.php File Doc
 *
 * Controller permettant la gestion des Activités
 *
 * PHP Version 5.6
 *
 * @category   File
 * @package    CentraleLille:NewsfeedBundle
 * @subpackage Controller
 * @author     Lechaptois Martin <martin.lechaptois@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link       https://github.com/EBMCentraleLille/fablab
 */

namespace CentraleLille\NewsFeedBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CentraleLille\NewsFeedBundle\Entity\Activity;
use CentraleLille\NewsFeedBundle\Form\ActivityType;

/**
 * ActivityController Class Doc
 *
 * Controller permettant la gestion des Activités
 *
 * @category   Controller
 * @package    CentraleLille:NewsfeedBundle
 * @subpackage Controller
 * @author     Lechaptois Martin <martin.lechaptois@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link       https://github.com/EBMCentraleLille/fablab
 */
class ActivityController extends Controller
{
    /**
    * IndexAction Function Doc
    *
    * Présentation de toutes les activités
    *
    * @return Twig La vue Twig à display
    */
    public function indexAction(request $request)
    {
        //Récupération des activités
        $activityService = $this->container->get('fablab_newsfeed.activities');
        $recentActivities = $activityService->getActivities(20);

        return $this->render(
            'CentraleLilleNewsFeedBundle:activity.html.twig',
            [
                'recentActivities' => $recentActivities
            ]
        );

    }

    /**
    * CreateAction Function Doc
    *
    * Fonction d'ajout d'activité
    *
    * @param Object $request Requête HTTP
    *
    * @return Twig La vue Twig à display
    */
    public function createAction(Request $request)
    {
        $activity = new Activity();
        $form = $this->createForm(ActivityType::class, $activity);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $activity->setDate(new \Datetime());
            $em = $this->getDoctrine()->getManager();
            $em->persist($activity);
            $em->flush();
            $session=$request->getSession()->getFlashBag()->add(
                'notice',
                "L'activité a bien été ajoutéz."
            );

            return $this->redirect(
                $this->generateUrl(
                    'centrale_lille_newsfeed_activity'
                )
            );
        }
        
        return $this->render(
            'CentraleLilleNewsFeedBundle:newactivity.html.twig',
            array(
            'form' => $form->createView()
            )
        );
    }
}
