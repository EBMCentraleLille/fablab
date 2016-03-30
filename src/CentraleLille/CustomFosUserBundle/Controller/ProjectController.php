<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 3/5/16
 * Time: 6:25 PM
 */

namespace CentraleLille\CustomFosUserBundle\Controller;

use CentraleLille\CustomFosUserBundle\Entity\Project;
use CentraleLille\CustomFosUserBundle\Entity\ProjectRole;
use CentraleLille\CustomFosUserBundle\Form\ProjectFormType;
use Proxies\__CG__\CentraleLille\CustomFosUserBundle\Entity\ProjectUser;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use CentraleLille\CustomFosUserBundle\Form;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Class ProjectController
 * @package CentraleLille\CustomFosUserBundle\Controller
 * @Route("/project")
 */
class ProjectController extends Controller
{
    /**
     * @Route("/show/{projectId}", name="project_show")
     * @param $projectId
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction($projectId, Request $request)
    {
        $session = new Session();
        $project = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('CustomFosUserBundle:Project')
            ->findOneById($projectId);

        $currentUser = $this->getUser();

        $projectService = $this->container->get('app.project.service');
        $usersOfProject = $projectService->getUsersOfProject($project);

        $usernameData = array();
        $form = $this->createFormBuilder($usernameData)
            ->add('username', 'text')
            ->add('roles', 'choice', array(
                'choices'  => array(
                    1 => null,
                    2 => 'PROJECT_LEADER'
                )))
            ->getForm();

        $error = $session->get('error');
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            $data = $form->getData();
            if ($projectService->isAllowedLeader($currentUser, $project)) {
                $username = $data['username'];
                $user = $this
                    ->getDoctrine()
                    ->getManager()
                    ->getRepository('CustomFosUserBundle:User')
                    ->findOneByUsername($username);
                if ($user != null) {
                    $projectUser = $projectService->addUserToProject($user, $project);
                    if ($data['roles'] == 2) {
                        $projectService->setUserToProjectLeaderWithProjectUser($projectUser);
                    }
                    $session->set('error', "");
                } else {
                    $session->set('error', "Cet utilisateur n'existe pas.");
                }
            } else {
                $session->set('error', "Vous devez être PROJECT_LEADER pour ajouter un nouveau membre.");
            }
            return $this->redirect($this->generateUrl('project_show', array('projectId' => $projectId)));
        }


        /**
         * Control access for members only
         */
        //$this->denyAccessUnlessGranted(ProjectRole::PROJECT_ROLE_MEMBER, $project);

        return $this->render(
            'CustomFosUserBundle:Project:show.html.twig',
            array(
                'project' => $project,
                'currentUser' => $currentUser,
                'projectUsers' => $usersOfProject,
                'formUsername' => $form->createView(),
                'error' => $error
            )
        );
    }

    /**
     * @Route("/edit/{projectId}", name="project_edit")
     * @param $projectId
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAction($projectId, Request $request)
    {
        $session = new Session();

        $em = $this->getDoctrine()->getManager();
        $project = $em
            ->getRepository('CustomFosUserBundle:Project')
            ->findOneById($projectId);

        $currentUser = $this->getUser();

        /**
         * Control access for members only
         */
        $this->denyAccessUnlessGranted(ProjectRole::PROJECT_ROLE_MEMBER, $project);

        $form = $this->get('form.factory')->create(new ProjectFormType('edit'), $project);

        $error = $session->get('error');
        $success = $session->get('success');

        if ($form->handleRequest($request)->isValid()) {
            $em->flush();
            $session->set('success', "Project updated successfully");
            return $this->redirect($this->generateUrl('project_edit', array('projectId' => $projectId)));
        } elseif ($request->isMethod('POST')) {
            $session->set('error', "Could not update project");
        }

        return $this->render('CustomFosUserBundle:Project:edit.html.twig', array(
            'form' => $form->createview(),
            'project' => $project,
            'currentUser' => $currentUser,
            'error' => $error,
            'success' => $success
        ));
    }

    /**
     * @Route("/new", name="project_new"))
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $project = new Project("hello");
        $form = $this->get('form.factory')->create(new ProjectFormType('create'), $project);

        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($project);

            $user = $this->getUser();
            $projectUser = new ProjectUser();
            $projectUser->setUser($user);
            $projectUser->setProject($project);
            $em->persist($projectUser);

            $em->flush();

            $this->container->get('app.project.service')->addUserToProject($user, $project);
            $this->container->get('app.project.service')->setUserToProjectLeader($user, $project);
            return $this->redirect($this->generateUrl('project_new'));

        } else {
            return $this->render('CustomFosUserBundle:Project:new.html.twig', array(
                'form' => $form->createview()
            ));
        }
    }

    /**
     * @Route("/show/{projectId}/{userId}", name="project_remove_user"))
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function removeUserFromProject($projectId, $userId)
    {
        $session = new Session();
        $project = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('CustomFosUserBundle:Project')
            ->findOneById($projectId);
        $user = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('CustomFosUserBundle:User')
            ->findOneById($userId);
        $currentUser = $this->getUser();
        $projectService = $this->container->get('app.project.service');
        if ($projectService->isAllowedLeader($currentUser, $project)) {
            $projectService->removeUserFromProject($user, $project);
        } else {
            $session->set('error', "Vous devez être PROJECT_LEADER pour retirer un membre.");
        }
        return $this->redirect($this->generateUrl('project_show', array('projectId' => $projectId)));
    }
}
