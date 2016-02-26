<?php

namespace CentraleLille\ReservationBundle\Controller;

use CentraleLille\ReservationBundle\Entity\Machine;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


class MachineController extends Controller
{
    public function addMachineAction(Request $request)
    {
        $machine = new Machine();

        $formBuilder = $this->get('form.factory')->createBuilder('form',$machine);

        $formBuilder
            ->add('machineName', 'text')
            ->add('description', 'textarea')
            ->add('Sauvegarder', 'submit')
            ;

        $form = $formBuilder->getForm();
        $form->handleRequest($request);

        if($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($machine);
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice',"La machine a bien été enregistrée");
            return $this->redirect($this->generateUrl('centrale_lille_add_machine',array('prenom'=>'Michelle','nom'=>'Jean', 'form'=> $form->createView())));
        }

        return $this->render('ReservationBundle::add.html.twig',array('prenom'=>'Michelle','nom'=>'Jean','form' => $form->createView()));
    }


    public function deleteMachineAction($id){
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('ReservationBundle:Machine');

        $machine = $repository ->find($id);

        $em->remove($machine);
        $em->flush();
        return $this->redirect($this->generateUrl('centrale_lille_administration',array('prenom'=>'Michelle', 'nom'=>'Jean')));
    }

}
