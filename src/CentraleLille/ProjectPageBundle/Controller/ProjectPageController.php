<?php
/**
 * ProjectPageController.php File Doc
 *
 * Controller permettant l'affichage de la page d'un projet sur la route /project/{projectId}
 *
 * PHP Version 5.5
 *
 * @category ProjectPageController
 * @package  ProjectPageBundle
 * @author   Hyot James <james.hyot@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/EBMCentraleLille/fablab
 */

namespace CentraleLille\ProjectPageBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CentraleLille\NewsFeedBundle\Entity\Activity;
use CentraleLille\ProjectPageBundle\Form\ActivityType;
use CentraleLille\CustomFosUserBundle\Entity\User;
use CentraleLille\CustomFosUserBundle\Entity\Project;
use CentraleLille\CustomFosUserBundle\Entity\ProjectUser;
use CentraleLille\CustomFosUserBundle\Entity\ProjectRole;

/**

 * ProjectPageController Class Doc
 *
 * Controller d'affichage d'un projet
 *
 * @category ProjectPageController
 * @package  ProjectPageBundle
 * @author   Hyot James <james.hyot@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/EBMCentraleLille/fablab
 */

class ProjectPageController extends Controller
{
    /**
     * displayProjectAction
     *
     * Affiche une page projet en utilisant l'ID du projet et en supposant récupérer les données du
     * projet grâce à un service
     *
     * @param String $projectId Id unique de projet, attribué à la création par le groupe Projet
     *        Request $request Requête http
     *
     * @return Response Une réponse à afficher
     */
    public function displayProjectAction($projectId, Request $request)
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $project = new Project();
        $project = $em
            ->getRepository('CustomFosUserBundle:Project')
            ->findOneBy(array('id'=>$projectId));

        if (!$project) {
        throw $this->createNotFoundException('Ce projet n\'existe pas !');
        }

        //Récupération des activités
        $activityService=$this->container->get('fablab_newsfeed.activities');
        $activities=$activityService->getActivityProjet($project, 3);     

        //Récupération des users du project (Entity = ProjectUser, il faut utiliser ->user
        //pour accéder à l'user
        $projectUsers = $em
            ->getRepository('CustomFosUserBundle:ProjectUser')
            ->findBy(array('project'=>$project));
        /* En fait c'est pas grave
        if (!$projectUsers) {
        throw $this->createNotFoundException('Ce projet n\'a pas d\'utilisateurs !');
        }
        */

        if($user){
            if ($user->hasProject($project->getName())) {
                
                //affichage du formulaire et gestion de la requête
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
                        )
                    );
                    
                }
                
            return $this->render(
                'ProjectPageBundle:Default:projectpage.html.twig',
                array(
                    'project' => $project,
                    'recentActivities' => $activities,
                    'form' => $form->createView(),
                    'projectUsers' => $projectUsers
                )
            );
            }
            return $this->render(
                'ProjectPageBundle:Default:projectpage.html.twig',
                array(
                    'project' => $project,
                    'recentActivities' => $activities,
                    'projectUsers' => $projectUsers
                )
            );
        }
        else{
            return $this->render(
                'ProjectPageBundle:Default:projectpage.html.twig', 
                array(
                    'project' => $project,
                    'recentActivities' => $activities,
                    'projectUsers' => $projectUsers
                    )
                );
        }
    }
}
