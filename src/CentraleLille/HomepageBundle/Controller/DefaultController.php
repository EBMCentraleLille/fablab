<?php

namespace CentraleLilleHomepageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CentraleLilleHomepageBundle:Default:index.html.twig');
    }
}
