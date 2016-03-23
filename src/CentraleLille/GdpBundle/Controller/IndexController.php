<?php

namespace CentraleLille\GdpBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        var_dump('weed');
        return $this->render(
            'CentraleLilleGdpBundle:index.html.twig',
            [
                'token' => 'temporary'
            ]
        );
    }
}
