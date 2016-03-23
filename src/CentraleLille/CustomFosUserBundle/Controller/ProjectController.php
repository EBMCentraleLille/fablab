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
use Symfony\Component\HttpFoundation\Request;

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
    public function showAction($projectId)
    {
        $project = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('CustomFosUserBundle:Project')
            ->findOneById($projectId);

        $currentUser = $this->getUser();

        /**
         * Control access for members only
         */
        //$this->denyAccessUnlessGranted(ProjectRole::PROJECT_ROLE_MEMBER, $project);

        return $this->render(
            'CustomFosUserBundle:Project:show.html.twig',
            array(
                'project' => $project,
                'currentUser' => $currentUser
            )
        );
    }

    /**
     * @Route("/edit/{projectId}", name="project_edit")
     * @param $projectId
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAction($projectId)
    {
        $project = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('CustomFosUserBundle:Project')
            ->findOneById($projectId);

        $currentUser = $this->getUser();

        /**
         * Control access for members only
         */
        $this->denyAccessUnlessGranted(ProjectRole::PROJECT_ROLE_MEMBER, $project);

        return $this->render(
            'CustomFosUserBundle:Project:edit.html.twig',
            array(
                'project' => $project,
                'currentUser' => $currentUser
            )
        );
    }

    /**
     * @Route("/new", name="project_new"))
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $project = new Project("hello");
        $form = $this->get('form.factory')->create(new ProjectFormType(), $project);

        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($project);

            $user = $this->getUser();
            $projectUser = new ProjectUser();
            $projectUser->setUser($user);
            $projectUser->setProject($project);
            $em->persist($projectUser);

            $em->flush();
            return $this->redirect($this->generateUrl('project_new'));

        } else {
            return $this->render('CustomFosUserBundle:Project:new.html.twig', array(
                'form' => $form->createview()
            ));
        }
    }
}
