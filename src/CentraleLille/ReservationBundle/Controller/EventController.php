<?php

namespace CentraleLille\ReservationBundle\Controller;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use CentraleLille\ReservationBundle\Entity\Event;
use CentraleLille\ReservationBundle\Entity\Machine;



class EventController extends Controller
{
    public function reserverAction()
    {
        $event = new Event();

        $formBuilder = $this -> get('form.factory')->createBuilder('form',$event);

        $form = $formBuilder -> add('startDateTime','date')
            ->add('endDateTime','date')
            ->add('machine', EntityType::class,array(
                'class'=> 'ReservationBundle:Machine',
                'choice_label'=>'machineName'))
            ->add('Sauvegarder','submit')->getForm();


            $em = $this->getDoctrine()->getManager();
            $repositoryEvent = $em->getRepository('ReservationBundle:Event');
            $em->persist($event);
            $em->flush();
            return $this->redirect($this->generateUrl('centrale_lille_machine',array('prenom'=>'Michelle','nom'=>'Jean', 'form'=> $form->createView())));

    }

    public function adminAction()
    {
        $em = $this->getDoctrine()->getManager();

        $repository = $em->getRepository('ReservationBundle:Machine');

        $machines = $repository->findAll();


        return $this->render('ReservationBundle::admin.html.twig',array('prenom'=>'Michelle','nom'=>'Jean','machines'=>$machines));
    }
}
