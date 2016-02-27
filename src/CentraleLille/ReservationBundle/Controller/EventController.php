<?php

namespace CentraleLille\ReservationBundle\Controller;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use CentraleLille\ReservationBundle\Entity\Event;
use CentraleLille\ReservationBundle\Entity\Machine;
use Symfony\Component\HttpFoundation\Request;



class EventController extends Controller
{
    public function reserverAction(Request $request)
    {
        $event = new Event();
        $event->setCreationDateTime();
        $formBuilder = $this->get('form.factory')->createBuilder('form', $event);

        $formBuilder->add('startDateTime', 'date')
            ->add('endDateTime', 'date')
            ->add('machine', EntityType::class, array(
                'class' => 'ReservationBundle:Machine',
                'choice_label' => 'machineName',
                'multiple' => false,
                'required' => true,
                'expanded' => true))
            ->add('Sauvegarder', 'submit');


            $form = $formBuilder->getForm();

            $form->handleRequest($request);

            if ($form->isSubmitted() && $request->isMethod("POST")) {

                if ($form->isValid()) {
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($event);
                    $em->flush();
                    $event = new Event();
                    $formBuilder = $this->get('form.factory')->createBuilder('form',$event);
                    $formBuilder->add('startDateTime', 'date')
                        ->add('endDateTime', 'date')
                        ->add('machine', EntityType::class, array(
                            'class' => 'ReservationBundle:Machine',
                            'choice_label' => 'machineName',
                            'multiple' => false,
                            'required' => true,
                            'expanded' => true))
                        ->add('Sauvegarder', 'submit');

                    $form = $formBuilder ->getForm();

                    return $this->render('ReservationBundle::reservation.html.twig',array('nom'=>"Michelle",'prenom'=>'Jean','form'=> $form->createView()));
                }
            }

            return $this->render('ReservationBundle::reservation.html.twig', array('nom' => 'Michelle', 'prenom' => 'Jean', 'form' => $form->createView()));

        }

    public function adminAction()
    {
        $em = $this->getDoctrine()->getManager();

        $repository = $em->getRepository('ReservationBundle:Machine');

        $machines = $repository->findAll();


        return $this->render('ReservationBundle::admin.html.twig',array('prenom'=>'Michelle','nom'=>'Jean','machines'=>$machines));
    }
}
