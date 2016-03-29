<?php

namespace CentraleLille\GdpBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        // Call jwt_manager service & create the token
        $token = $this->get('lexik_jwt_authentication.jwt_manager')->create($this->getUser());

        return $this->render(
            'CentraleLilleGdpBundle:Default:index.html.twig',
            [
                'token' => $token
            ]
        );
    }
}
