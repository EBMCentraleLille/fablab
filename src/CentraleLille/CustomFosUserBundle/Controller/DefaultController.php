<?php

namespace CentraleLille\CustomFosUserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/customfosuser")
     */
    public function indexAction()
    {
        return $this->render('CustomFosUserBundle:Default:index.html.twig');
    }
}
