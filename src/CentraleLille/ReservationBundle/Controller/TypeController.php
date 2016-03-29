<?php
/**
 * Created by PhpStorm.
 * User: windownet
 * Date: 14/03/2016
 * Time: 09:37
 */

namespace CentraleLille\ReservationBundle\Controller;

use CentraleLille\ReservationBundle\Entity\Bookables\Type;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TypeController extends Controller
{
    public function createAction(Request $request)
    {
        $type = new Type();

        $formBuilder =$this->get('form.factory')->createBuilder('form', $type);

        $formBuilder->add('name', 'text')
        ->add('description', 'textarea')
        ->add('Sauvegarder', 'submit');

        $form = $formBuilder->getForm();

        $form->handleRequest($request);

        if ($request->isMethod('POST') && $form->isValid()) {
            $em =$this->getDoctrine()->getManager();
            $types = $em->getRepository('ReservationBundle:Bookables\Type');
            $test = false;
            foreach ($types as $typ) {
                if ($type->getName() == $typ->getName()) {
                    $test = true;
                }
            }
            if ($test == false) {
                $em->persist($type);
                $em->flush();
            }
            return $this->redirectToRoute('centrale_lille_types', array('form' =>$form->createView()));
        }

        return $this->render('ReservationBundle::types.html.twig', array('form'=> $form->createView()));
    }

    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $types = $em->getRepository('ReservationBundle:Bookables\Type')->findAll();

        return $this->render('ReservationBundle::typeList.html.twig', array('types'=>$types));

    }
}
