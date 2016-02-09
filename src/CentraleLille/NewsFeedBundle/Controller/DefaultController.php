<?php

namespace CentraleLille\NewsFeedBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CentraleLilleNewsFeedBundle:newsFeed.html.twig');
    }
}
