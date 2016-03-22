<?php
namespace CentraleLille\GdpBundle\Controller;

/**
 * Abstract list of tasks.
 */
class TaskListController extends FOSTRestController
{
    /**
     * Create a Task List from the submitted data.<br/>
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
     * @RequestParam(name="title", nullable=false, strict=true, description="Title.")
     * @RequestParam(name="body", nullable=false, strict=true, description="Body.")
     *
     * @return View
     */
     public postTaskListAction(ParamFetcher $paramFetcher)
     {
        $taskListRepository = $this->getDoctrine()->getRepository('CentraleLilleGdpBundle:TaskList');
        $taskList = new Task();
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
     *     404 = "Returned when the task is not found"
     *   }
     * )
     *
     * @param int $taskId id
     *
     * @return View
     */
     public function deleteTaskListAction($taskListId)
     {
          $repo = $this->getDoctrine()->getRepository('CentraleLilleGdpBundle:TasklList');
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
          $view->setData("Task list deteled.")->setStatusCode(200);
          return $view;
     }

     //TODO
     public function putTaskList(ParamFetcher $param)
     {
          //TODO
     }
    /**
     * Return the tasks corresponding to the given task list id
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Return all tasks from TaskList",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the task is not found"
     *   }
     * )
     *
     * @param int $id id
     *
     * @return View
     */
	public function getTasksAction($taskListId)
     {
          $repo = $this->getDoctrine()->getRepository('CentraleLilleGdpBundle:TasklList');
          $taskList = $repo->findOneBy(
               array('id' => $taskListId)
          );
          if (!$taskList) {
            throw $this->createNotFoundException('Data not found.');
          }
          $allTasks = $taskList->getTasks();
          $view = View::create();
          $view->setData($allTasks);
          return $view;
     }

    /**
     * Add a task to the list
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Add a task to the list",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the user is not found"
     *   }
     * )
     *
     * @param int $taskListId taskListId
     * @param int $taskId taskId
     *
     * @return View
     */
     putAddTaskAction($taskListId, $taskId)
     {
        $repoTasks = $this->getDoctrine()->getRepository('CentraleLilleGdpBundle:Task');
        $repoTaskLists = $this->getDoctrine()->getRepository('CustomFosUserBundle:TaskList');
        $task = $repoTasks->findOneBy(
            array('id' => $taskId)
        );
        // Retrieves task & user
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