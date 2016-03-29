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
     * DisplayProjectAction
     *
     * Affiche une page projet en utilisant l'ID du projet et en supposant récupérer les données du
     * projet grâce à un service
     *
     * @param String  $projectId Id unique de projet, attribué à la création par le groupe Projet
     * @param Request $request   Requête http
     *
     * @return Response Une réponse à afficher
     */
    public function displayProjectAction($projectId, Request $request)
    {
        
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $project = $em
            ->getRepository('CustomFosUserBundle:Project')
            ->findOneBy(array('id'=>$projectId));
        if (!$project) {
            throw $this->createNotFoundException('Ce projet n\'existe pas !');
        }

        //Récupération des activités
        $activityService=$this->container->get('fablab_newsfeed.activities');
        $activities=$activityService->getActivityProjet($project, 30);

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

        if ($user) {
            //Le user est-il abonné à ce projet?
            $abonnementService = $this->container->get('fablab_newsfeed.abonnements');
            $isAbo = $abonnementService->isAboProjet($user, $project);
            
            //récupération du projet liké/déliké
            $projectName = $request->request->get('projet');
            if ($projectName) {
                $em = $this->getDoctrine()->getManager();
                $projet=$em->getRepository("CustomFosUserBundle:Project")->findOneBy(array('name'=>$projectName));
                
                //Abonnement/désabonnement du user au projet en question
                $abonnementService=$this->container->get('fablab_newsfeed.abonnements');
                if ($abonnementService->isAboProjet($user, $projet)) {
                    $recentActivities=$abonnementService->removeAboProjet($user, $projet);
                } else {
                    $recentActivities=$abonnementService->addAboProjet($user, $projet);
                }
            }

            if ($user->hasProject($project->getName())) {
                //affichage du formulaire et gestion de la requête
                $activity = new Activity();
                $form = $this->createForm(ActivityType::class, $activity);
                $activity->setUser($user);
                $activity->setProject($project);
                $activity->setType('custom');

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
                            'project_page_homepage',
                            array(
                                'projectId' => $projectId
                            )
                        )
                    );
                }
                return $this->render(
                    'ProjectPageBundle:Default:projectpage.html.twig',
                    array(
                        'project'          => $project,
                        'recentActivities' => $activities,
                        'form'             => $form->createView(),
                        'projectUsers'     => $projectUsers,
                        'isAbo'            => $isAbo
                    )
                );
            }
        }
        $isAbo = 0;
        return $this->render(
            'ProjectPageBundle:Default:projectpage.html.twig',
            array(
                'project'          => $project,
                'recentActivities' => $activities,
                'projectUsers'     => $projectUsers,
                'isAbo'            => $isAbo
                )
        );
    }

    /**
     * DeleteActivityAction
     *
     * Supprime une activité
     *
     * @param String  $projectId  Id unique de projet, attribué à la création par le groupe Projet
     * @param String  $activityId Id unique d'activité
     * @param Request $request    Requête http
     *
     * @return Response Une réponse à afficher
     */
    public function deleteActivityAction($projectId, $activityId, Request $request)
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $project = $em
            ->getRepository('CustomFosUserBundle:Project')
            ->findOneBy(array('id'=>$projectId));
        if (!$project) {
            throw $this->createNotFoundException('Ce projet n\'existe pas !');
        }

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

        if ($user) {
            //Le user est-il abonné à ce projet?
            $abonnementService = $this->container->get('fablab_newsfeed.abonnements');
            $isAbo = $abonnementService->isAboProjet($user, $project);
            
            //récupération du projet liké/déliké
            $projectName = $request->request->get('projet');
            if ($projectName) {

                $em = $this->getDoctrine()->getManager();
                $projet=$em->getRepository("CustomFosUserBundle:Project")->findOneBy(array('name'=>$projectName));
                
                //Abonnement/désabonnement du user au projet en question
                $abonnementService=$this->container->get('fablab_newsfeed.abonnements');
                if ($abonnementService->isAboProjet($user, $projet)) {
                    $recentActivities=$abonnementService->removeAboProjet($user, $projet);
                } else {
                    $recentActivities=$abonnementService->addAboProjet($user, $projet);
                }
            }

            if ($user->hasProject($project->getName())) {
                //suppression de l'activity visée
                $activitydeleted = $em
                    ->getRepository('CentraleLilleNewsFeedBundle:Activity')
                    ->findOneBy(array('id'=>$activityId));
                if ($activitydeleted) {
                    $em->remove($activitydeleted);
                    $em->flush();
                }
                

                //affichage du formulaire et gestion de la requête
                $activity = new Activity();
                $form = $this->createForm(ActivityType::class, $activity);
                $activity->setUser($user);
                $activity->setProject($project);
                $activity->setType('custom');

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
                            'project_page_homepage',
                            array(
                                'projectId' => $projectId
                            )
                        )
                    );
                }
                //Récupération des activités
                $activityService=$this->container->get('fablab_newsfeed.activities');
                $activities=$activityService->getActivityProjet($project, 30);
                return $this->render(
                    'ProjectPageBundle:Default:projectpage.html.twig',
                    array(
                        'project'          => $project,
                        'recentActivities' => $activities,
                        'form'             => $form->createView(),
                        'projectUsers'     => $projectUsers,
                        'isAbo'            => $isAbo
                    )
                );
            }
        }
        //Récupération des activités
        $activityService=$this->container->get('fablab_newsfeed.activities');
        $activities=$activityService->getActivityProjet($project, 30);
        $isAbo = 0;
        return $this->render(
            'ProjectPageBundle:Default:projectpage.html.twig',
            array(
                'project'          => $project,
                'recentActivities' => $activities,
                'projectUsers'     => $projectUsers,
                'isAbo'            => $isAbo
                )
        );
    }
}
