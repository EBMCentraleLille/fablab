<?php

namespace CentraleLille\ReservationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{

    public function indexAction()
    {
        return new Response("Ici on va réserver les machines");
    }

    public function salleAction()
    {
        return new Response("Ici on va réserver la salle");
    }

    public function casierAction()
    {
        return new Response("Ici on va réserver les casiers");
    }
}
