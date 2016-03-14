<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 14/03/16
 * Time: 09:50
 */

namespace CentraleLille\GdpBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use CentraleLille\CustomFosUserBundle\Entity\Project;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class UserController extends FOSRestController
{
    /**
     * Return the project members.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Return the project members",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when no users are found"
     *   }
     * )
     *
     * @param int $id id
     *
     * @return View
     */
    public function getProjectUsersAction($id)
    {
        $projectRepository = $this->getDoctrine()->getRepository('CentraleLilleCustomFosUserBundle:Project');
        $users = $projectRepository->find($id)->getProjectUsers();
        if (!$users) {
            throw $this->createNotFoundException('Data not found.');
        }
        $view = View::create();
        $view->setData($users)->setStatusCode(200);
        return $view;
    }

    /**
     * Return the project .
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Return the project",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when no users are found"
     *   }
     * )
     *
     * @param int $id id
     *
     * @return View
     */
    public function getProjectAction($id)
    {
        $projectRepository = $this->getDoctrine()->getRepository('CentraleLilleCustomFosUserBundle:Project');
        $project = $projectRepository->find($id);
        if (!$project) {
            throw $this->createNotFoundException('Data not found.');
        }
        $view = View::create();
        $view->setData($project)->setStatusCode(200);
        return $view;
    }

}