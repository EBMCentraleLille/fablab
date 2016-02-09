<?php

namespace CentraleLille\ProjectPageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function displayProjectAction($projectId)
    {
        return $this->render('ProjectPageBundle:Default:projectpage.html.twig', array(
            'projectId' =>$projectId)
        );
    }
}
