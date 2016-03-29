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
use CentraleLille\CustomFosUserBundle\Entity\User;
use CentraleLille\CustomFosUserBundle\Entity\Project;
use CentraleLille\CustomFosUserBundle\Entity\ProjectUser;
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
        $projectRepository = $this->getDoctrine()->getRepository('CustomFosUserBundle:ProjectUser');
        $projectUsers = $projectRepository->findByProject($id);
        foreach ($projectUsers as $projectUser) {
            $users[]=['id'=>$projectUser->getUser()->getId(),
                'username'=>$projectUser->getUser()->getUsername(),
                'firstname'=>$projectUser->getUser()->getFirstname(),
                'lastname'=>$projectUser->getUser()->getLastname(),
                ];
        }
        if (!$users) {
            throw $this->createNotFoundException('Data not found.');
        }
        $view = View::create();
        $view->setData($users)->setStatusCode(200);
        return $view;
    }

    /**
     * Return the project associated to a user.
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
     * @return View
     */
    public function getUsersProjectAction()
    {
        $projectRepository = $this->getDoctrine()->getRepository('CustomFosUserBundle:ProjectUser');
        $id= $this->getUser()->getId();
        $projectUsers = $projectRepository->findByUser($id);
        foreach ($projectUsers as $projectUser) {
            $projects[]=['id'=>$projectUser->getProject()->getId(),'name'=>$projectUser->getProject()->getName()];
        }
        if (!$projects) {
            throw $this->createNotFoundException('Data not found.');
        }
        $view = View::create();
        $view->setData($projects)->setStatusCode(200);
        return $view;
    }
}
