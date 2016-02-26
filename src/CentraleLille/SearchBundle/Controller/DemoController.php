<?php

namespace CentraleLille\SearchBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use CentraleLille\SearchBundle\Entity\Demo;
use CentraleLille\SearchBundle\Form\DemoType;

/**
 * Demo controller.
 *
 * @Route("/demo")
 */
class DemoController extends Controller
{
    /**
     * Lists all Demo entities.
     *
     * @Route("/", name="demo_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $demos = $em->getRepository('CentraleLilleSearchBundle:Demo')->findAll();

        return $this->render('demo/index.html.twig', array(
            'demos' => $demos,
        ));
    }

    /**
     * Creates a new Demo entity.
     *
     * @Route("/new", name="demo_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $demo = new Demo();
        $form = $this->createForm('CentraleLille\SearchBundle\Form\DemoType', $demo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($demo);
            $em->flush();

            return $this->redirectToRoute('demo_show', array('id' => $demo->getId()));
        }

        return $this->render('demo/new.html.twig', array(
            'demo' => $demo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Demo entity.
     *
     * @Route("/{id}", name="demo_show")
     * @Method("GET")
     */
    public function showAction(Demo $demo)
    {
        $deleteForm = $this->createDeleteForm($demo);

        return $this->render('demo/show.html.twig', array(
            'demo' => $demo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Demo entity.
     *
     * @Route("/{id}/edit", name="demo_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Demo $demo)
    {
        $deleteForm = $this->createDeleteForm($demo);
        $editForm = $this->createForm('CentraleLille\SearchBundle\Form\DemoType', $demo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($demo);
            $em->flush();

            return $this->redirectToRoute('demo_edit', array('id' => $demo->getId()));
        }

        return $this->render('demo/edit.html.twig', array(
            'demo' => $demo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Demo entity.
     *
     * @Route("/{id}", name="demo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Demo $demo)
    {
        $form = $this->createDeleteForm($demo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($demo);
            $em->flush();
        }

        return $this->redirectToRoute('demo_index');
    }

    /**
     * Creates a form to delete a Demo entity.
     *
     * @param Demo $demo The Demo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Demo $demo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('demo_delete', array('id' => $demo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
