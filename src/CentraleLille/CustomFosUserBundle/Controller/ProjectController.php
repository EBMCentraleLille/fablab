<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 3/5/16
 * Time: 6:25 PM
 */

namespace CentraleLille\CustomFosUserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class ProjectController
 * @package CentraleLille\CustomFosUserBundle\Controller
 * @Route("/project")
 */
class ProjectController extends Controller
{
    /**
     * @Route("/{projectId}", name="project_show")
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
        $this->denyAccessUnlessGranted('MEMBER', $project);

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
        $this->denyAccessUnlessGranted('LEADER', $project);

        return $this->render(
            'CustomFosUserBundle:Project:edit.html.twig',
            array(
                'project' => $project,
                'currentUser' => $currentUser
            )
        );
    }
}
