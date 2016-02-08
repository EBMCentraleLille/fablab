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
    }
}
