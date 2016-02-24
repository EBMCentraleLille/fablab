<?php

namespace CentraleLille\ReservationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction()
    { // En attendant de récupérer directement le $user pour avoir ses informations perso.
        return $this->render('ReservationBundle:Default:index.html.twig',array('prenom'=>'Michelle','nom'=>'Jean','role'=>'Admin'));
    }

    public function salleAction()
    {
        return new Response("Ici on va réserver la salle");
    }

    public function casierAction()
    {
        return new Response("Ici on va réserver les casiers");
    }
    public function adminAction()
    {
        $em = $this->getDoctrine()->getManager();

        $repository = $em->getRepository('ReservationBundle:Machine');

        $machines = $repository->findAll();


        return $this->render('ReservationBundle::admin.html.twig',array('prenom'=>'Michelle','nom'=>'Jean','machines'=>$machines));
    }
}
