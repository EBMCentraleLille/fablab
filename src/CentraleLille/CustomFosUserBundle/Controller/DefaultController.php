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
        $users = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('CustomFosUserBundle:User')
            ->findAll();

        $currentUser = $this->getUser();

        return $this->render(
            'CustomFosUserBundle:Default:index.html.twig',
            array(
            'users' => $users,
            'currentUser' => $currentUser
            )
        );
    }
}
