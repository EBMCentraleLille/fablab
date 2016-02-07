<?php

namespace ProjectPageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ProjectPageBundle:Default:index.html.twig');
    }
}
