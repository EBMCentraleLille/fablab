<?php

namespace CentraleLille\GdpBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use CentraleLille\GdpBundle\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use CentraleLille\GdpBundle\Form\TaskType;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Request\ParamFetcher;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\Validator\ConstraintViolationList;

class TaskController extends FOSRestController
{
    /**
     * Return the overall user list.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Return the overall Task List",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the task is not found"
     *   }
     * )
     *
     * @return View
     */
    public function getTasksAction()
    {
        $taskRepository = $this->getDoctrine()->getRepository('CentraleLilleGdpBundle:Task');
        $list = $taskRepository->findAll();
        if (!$list) {
            throw $this->createNotFoundException('Data not found.');
        }
        $view = View::create();
        $view->setData($list)->setStatusCode(200);
        return $view;
    }


    /**
     * Create a Task from the submitted data.<br/>
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Creates a new task from the submitted data.",
     *   statusCodes = {
     *     201 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @param ParamFetcher $paramFetcher Paramfetcher
     *
     * @RequestParam(name="title", nullable=false, strict=true, description="Title.")
     * @RequestParam(name="body", nullable=false, strict=true, description="Body.")
     *
     * @return View
     */
    public function postTaskAction(ParamFetcher $paramFetcher)
    {
        $taskRepository = $this->getDoctrine()->getRepository('CentraleLilleGdpBundle:Task');
        $task = new Task();
        $task->setTitle($paramFetcher->get('title'));
        $task->setBody($paramFetcher->get('body'));
        // TODO get current user
        $task->setAuthor('JunkOS');
        $task->setStatus(false);
        $view = View::create();
        $errors = $this->get('validator')->validate($task, array('Registration'));
        if (count($errors) == 0) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();
            $view->setData($task)->setStatusCode(201);
            return $view;
        } else {
            $view = $this->getErrorsView($errors);
            return $view;
        }
    }

    /**
     * Update a Task from the submitted data by ID.<br/>
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Updates a task from the submitted data by ID.",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @param ParamFetcher $paramFetcher Paramfetcher
     *
     * @RequestParam(name="id", nullable=false, strict=true, description="Id.")
     * @RequestParam(name="title", nullable=true, strict=true, description="Title.")
     * @RequestParam(name="body", nullable=true, strict=true, description="Body.")
     * @RequestParam(name="status", nullable=true, strict=true, description="Status.")
     *
     * @return View
     */
    public function putTaskAction(ParamFetcher $paramFetcher)
    {
        $task = $this->getDoctrine()->getRepository('CentraleLilleGdpBundle:Task')->findOneBy(
            array('id' => $paramFetcher->get('id'))
        );
        if ($paramFetcher->get('title')) {
            $task->setTitle($paramFetcher->get('title'));
        }
        if ($paramFetcher->get('body')) {
            $task->setBody($paramFetcher->get('body'));
        }
        if ($paramFetcher->get('status')) {
            $task->setStatus($paramFetcher->get('status'));
        }
        $view = View::create();
        $errors = $this->get('validator')->validate($task, array('Update'));
        if (count($errors) == 0) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();
            $view->setData($task)->setStatusCode(200);
            return $view;
        } else {
            $view = $this->getErrorsView($errors);
            return $view;
        }
    }

    /**
     * Delete a task identified by id.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Delete a task identified by id",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the user is not found"
     *   }
     * )
     *
     * @param int $id id
     *
     * @return View
     */
    public function deleteTaskAction($id)
    {
        $repo = $this->getDoctrine()->getRepository('CentraleLilleGdpBundle:Task');
        $task = $repo->findOneBy(
            array('id' => $id)
        );
        if (!$task) {
            throw $this->createNotFoundException('Data not found.');
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($task);
        $em->flush();
        $view = View::create();
        $view->setData("Task deteled.")->setStatusCode(200);
        return $view;
    }

    /**
     * Get the validation errors
     *
     * @param ConstraintViolationList $errors Validator error list
     *
     * @return View
     */
    protected function getErrorsView(ConstraintViolationList $errors)
    {
        $msgs = array();
        $errorIterator = $errors->getIterator();
        foreach ($errorIterator as $validationError) {
            $msg = $validationError->getMessage();
            $params = $validationError->getMessageParameters();
            $msgs[$validationError->getPropertyPath()][] = $this->get('translator')->trans($msg, $params, 'validators');
        }
        $view = View::create($msgs);
        $view->setStatusCode(400);
        return $view;
    }
}
