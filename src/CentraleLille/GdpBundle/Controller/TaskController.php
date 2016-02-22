<?php

namespace CentraleLille\GdpBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class TaskController extends Controller
{
    /**
     * @Route("/tasks")
     */
    public function indexAction()
    {
        return $this->render('CentraleLilleGdpBundle:Tasks:tasks.html.twig');

        ///  array(
      //  'name' => $name
    //)
        ///
        ///
    }

    public function getTasksAction()
    {
        $em = $this->getDoctrine()->getManager();
        return $this->entityManager->getRepository('AppBlogBundle:Blog')->find($blogId);
    }

    public function addTaskAction()
    {
        $em = $this->getDoctrine()->getManager();
    }

    ///**
    // * @Route("/tasks/{id}", id=null)
    // */

    public function getOneTaskAction($id, Request $request)
    {
        $page = $request->query->get('task', $id);
        //$templating = $this->get('templating');

        //$router = $this->get('router');

        //$mailer = $this->get('mailer');

        //$response = new Response(json_encode(array('id' => $id)));
        //$response->headers->set('Content-Type', 'application/json');

        //return $response;
    }
}
