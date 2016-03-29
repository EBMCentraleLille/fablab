<?php
/**
 * Created by PhpStorm.
 * User: j.quero
 * Date: 29/03/2016
 * Time: 10:46
 */

namespace CentraleLille\GdpBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpKernel\Exception\HttpException;
use CentraleLille\CustomFosUserBundle\Entity\ProjectUser;

class GdpRestController extends FOSRestController
{
    /**
     * Control that the user is a member of the project
     * Return 401 exception if not
     *
     * @param $projectId
     * @param $userId
     */
    public function existsProjectUser($projectId, $userId)
    {
        $projectRepository = $this->getDoctrine()->getRepository('CustomFosUserBundle:ProjectUser');
        $projectUser = $projectRepository->findBy(
            array('user'=>$userId,'project'=>$projectId)
        );
        if (!$projectUser) {
            throw new HttpException(401, 'User can not access this project');
        }
    }
}
