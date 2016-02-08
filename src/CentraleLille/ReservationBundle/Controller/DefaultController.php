<?php

namespace CentraleLille\ReservationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction()
    { // En attendant de récupérer directement le $user pour avoir ses informations perso.
        return $this->render('ReservationBundle:Default:index.html.twig',array('prenom'=>'Jean','nom'=>'Baptiste'));
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
