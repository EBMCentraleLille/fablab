<?php

namespace CentraleLille\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CentraleLilleDemoBundle:Default:index.html.twig');
    }
}
