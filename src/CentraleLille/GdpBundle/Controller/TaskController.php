<?php

namespace CentraleLille\GdpBundle\Controller;

use CentraleLille\GdpBundle\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use CentraleLille\GdpBundle\Form\TaskType;

class TaskController extends Controller
{
    /**
     * @Route("/tasks")
     */
    public function indexAction()
    {
        return $this->render('CentraleLilleGdpBundle:Task:index.html.twig');
    }


    /**
     * @Route("/tasks/add", name="gdp_add_task")
     */
    public function addAction(Request $request){

        $task = new Task();
        $form = $this->get('form.factory')->create(new TaskType(), $task);

        if ($form->handleRequest($request)->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Tâche bien enregistrée.');

            return $this->redirect($this->generateUrl('gdp_personal_page'));

        }
        return $this->render('CentraleLilleGdpBundle:Task:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
