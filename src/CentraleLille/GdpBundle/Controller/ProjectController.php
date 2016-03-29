<?php
/**
 * Created by PhpStorm.
 * User: j.quero
 * Date: 14/03/2016
 * Time: 09:20
 */

namespace CentraleLille\GdpBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Request\ParamFetcher;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\Validator\ConstraintViolationList;

class ProjectController extends GdpRestController
{
    /**
     * Return the overall project list.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Return the overall Project List",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the task is not found"
     *   }
     * )
     *
     *
     * @return View
     */
    public function getProjectsAction()
    {
        $projRepository = $this->getDoctrine()->getRepository('CustomFosUserBundle:Project');
        $list = $projRepository->findAll();
        if (!$list) {
            throw $this->createNotFoundException('Data not found.');
        }
        $view = View::create();
        $view->setData($list)->setStatusCode(200);
        return $view;
    }

    /**
     * Return the project with the indicated id.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Return the project",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when no projects are found"
     *   }
     * )
     *
     * @param int $id id
     *
     * @return View
     */
    public function getProjectAction($id)
    {
        $projectRepository = $this->getDoctrine()->getRepository('CustomFosUserBundle:Project');
        $project = $projectRepository->find($id);
        $this->existsProjectUser($id, $this->getUser()->getId());
        if (!$project) {
            throw $this->createNotFoundException('Data not found.');
        }
        $view = View::create();
        $view->setData($project)->setStatusCode(200);
        return $view;
    }
}
