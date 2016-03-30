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
use CentraleLille\CustomFosUserBundle\Entity\User;

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
    * @param Object $request Requête HTTP
    *
    * @return Twig La vue Twig à display
    */
    public function indexAction(Request $request)
    {
        $user = $this->getUser();
        if (!$user) {
            $session=$request->getSession()->getFlashBag()->add(
                'notice',
                "Vous devez être connecté pour accéder à cette page."
            );
            return $this->redirectToRoute('fos_user_security_login');
        } elseif (!$this->get('security.context')->isGranted('ROLE_ADMIN')) {
            $session=$request->getSession()->getFlashBag()->add(
                'notice',
                "Vous n'avez pas les droits d'accéder à cette page."
            );
            return $this->redirectToRoute('fos_user_profile_show');
        } else {
            //Récupération des activités
            $activityService=$this->container->get('fablab_newsfeed.activities');
            $activities=$activityService->getActivities(30);
            
            return $this->render(
                'CentraleLilleNewsFeedBundle:Default:activity.html.twig',
                [
                    'recentActivities' => $activities
                ]
            );
        }
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
        $user = $this->getUser();
        if (!$user) {
            $session=$request->getSession()->getFlashBag()->add(
                'notice',
                "Vous devez être connecté pour accéder à cette page."
            );
            return $this->redirectToRoute('fos_user_security_login ');
        } elseif (!$this->get('security.context')->isGranted('ROLE_ADMIN')) {
            $session=$request->getSession()->getFlashBag()->add(
                'notice',
                "Vous n'avez pas les droits d'accéder à cette page."
            );
            return $this->redirectToRoute('fos_user_profile_show');
        } else {
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
                    "L'activité a bien été ajoutée."
                );

                return $this->redirect(
                    $this->generateUrl(
                        'centrale_lille_newsfeed_activity'
                    )
                );
            }
            
            return $this->render(
                'CentraleLilleNewsFeedBundle:Default:newactivity.html.twig',
                array(
                'form' => $form->createView()
                )
            );
        }
    }
}
