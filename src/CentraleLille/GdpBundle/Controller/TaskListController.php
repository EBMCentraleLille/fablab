<?php

namespace CentraleLille\GdpBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use CentraleLille\GdpBundle\Entity\Task;
use CentraleLille\GdpBundle\Entity\TaskList;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Request\ParamFetcher;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
* Abstract list of tasks.
*/
class TaskListController extends FOSRestController
{
    /**
    * Create a Task List from the submitted data.<br/>.
    *
    * @ApiDoc(
    *   resource = true,
    *   description = "Creates a new task list from the submitted data.",
    *   statusCodes = {
    *     201 = "Returned when successful",
    *     400 = "Returned when the form has errors"
    *   }
    * )
    *
    * @param ParamFetcher $paramFetcher Paramfetcher
    *
    * @RequestParam(name="name", nullable=false, strict=true, description="Name.")
    *
    * @return View
    */
    public function postListAction(ParamFetcher $paramFetcher)
    {
        $taskListRepository = $this->getDoctrine()->getRepository('CentraleLilleGdpBundle:TaskList');
        $taskList = new TaskList();
        $taskList->setTitle($paramFetcher->get('name'));
        $view = View::create();
        $errors = $this->get('validator')->validate($task, array('Registration'));
        if (count($errors) == 0) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($taskList);
            $em->flush();
            $view->setData($taskList)->setStatusCode(201);

            return $view;
        } else {
            $view = $this->getErrorsView($errors);

            return $view;
        }
    }

    /**
    * Delete a task list identified by id.
    *
    * @ApiDoc(
    *   resource = true,
    *   description = "Delete a task list identified by TaskList id",
    *   statusCodes = {
    *     200 = "Returned when successful",
    *     404 = "Returned when the task list is not found"
    *   }
    * )
    *
    * @param int $taskListId id
    *
    * @return View
    */
    public function deleteListAction($taskListId)
    {
        $repo = $this->getDoctrine()->getRepository('CentraleLilleGdpBundle:TaskList');
        $taskList = $repo->findOneBy(
            array('id' => $taskListId)
        );
        if (!$taskList) {
            throw $this->createNotFoundException('Data not found.');
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($taskList);
        $em->flush();
        $view = View::create();
        $view->setData('Task list deteled.')->setStatusCode(200);

        return $view;
    }

    /**
    * Add a list specified by id to the taskList.<br/>.
    *
    * @ApiDoc(
    *   resource = true,
    *   description = "Update a task list with the specified params.",
    *   statusCodes = {
    *     200 = "Returned when successful",
    *     400 = "Returned when the form has errors"
    *   }
    * )
    *
    * @param int $taskListId TaskListId
    * @param ParamFetcher $paramFetcher Paramfetcher
    *
    * @RequestParam(name="name", nullable=false, strict=true, description="Name.")
    *
    * @return View
    */
    public function putListAction($taskListId, ParamFetcher $param)
    {
        $task = $this->getDoctrine()->getRepository('CentraleLilleGdpBundle:TaskList')->findOneBy($taskListId);
        if ($paramFetcher->get('name')) {
            $taskList->setName($paramFetcher->get('name'));
        }
        $view = View::create();
        $errors = $this->get('validator')->validate($task, array('Update'));
        if (count($errors) == 0) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($taskList);
            $em->flush();
            $view->setData($taskList)->setStatusCode(200);

            return $view;
        } else {
            $view = $this->getErrorsView($errors);

            return $view;
        }
    }

    /**
    * Return the tasks corresponding to the given task list id.
    *
    * @ApiDoc(
    *   resource = true,
    *   description = "Return all tasks from TaskList",
    *   statusCodes = {
    *     200 = "Returned when successful",
    *     404 = "Returned when the task list is not found"
    *   }
    * )
    *
    * @param int $taskListId taskListId
    *
    * @return View
    */
    public function getListAction($taskListId)
    {
        $repo = $this->getDoctrine()->getRepository('CentraleLilleGdpBundle:TaskList');
        $taskList = $repo->findOneBy(
            array('id' => $taskListId)
        );
        if (!$taskList) {
            throw $this->createNotFoundException('Data not found.');
        }
        $view = View::create();
        $view->setData($taskList);

        return $view;
    }

    /**
    * Add a task to the list.
    *
    * @ApiDoc(
    *   resource = true,
    *   description = "Add a task to the list",
    *   statusCodes = {
    *     200 = "Returned when successful",
    *     404 = "Returned when the task list is not found"
    *   }
    * )
    *
    * @param int $taskListId taskListId
    * @param int $taskId taskId
    *
    * @return View
    */
    public function putListAddAction($taskListId, $taskId)
    {
        $repoTasks = $this->getDoctrine()->getRepository('CentraleLilleGdpBundle:Task');
        $repoTaskLists = $this->getDoctrine()->getRepository('CentraleLilleGdpBundle:TaskList');
        $task = $repoTasks->findOneBy(
            array('id' => $taskId)
        );
        // Retrieves task & taskList
        if (!$task) {
            throw $this->createNotFoundException('Task not found.');
        }
        $taskList = $repoTaskLists->findOneBy(
            array('id' => $taskListId)
        );
        if (!$taskList) {
            throw $this->createNotFoundException('Task list not found.');
        }
        $taskList->addTask($task);
        $task->addTaskList($taskList);
        $em = $this->getDoctrine()->getManager();
        $em->persist($taskList);
        $em->persist($task);
        $em->flush();
        $view = View::create();
        $view->setData($task)->setStatusCode(200);

        return $view;
    }

    /**
    * Return all the tasklists for a specific project.
    *
    * @ApiDoc(
    *   resource = true,
    *   description = "Return all task lists for a given project",
    *   statusCodes = {
    *     200 = "Returned when successful",
    *     404 = "Returned when the project is not found"
    *   }
    * )
    *
    * @param int $id id
    *
    * @return View
    */
    public function getProjectListsAction($id)
    {
        $repoTaskLists = $this->getDoctrine()->getRepository('CentraleLilleGdpBundle:TaskList');
        $list = $repoTaskLists->findByProject($id);
        if (!$list) {
            throw $this->createNotFoundException('Data not found.');
        }
        $view = View::create();
        $view->setData($list)->setStatusCode(200);

        return $view;
    }

    /**
    * Get the validation errors.
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
