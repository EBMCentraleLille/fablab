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
    // /**
    //  * Update a User from the submitted data by ID.<br/>
    //  *
    //  * @Secure(roles="ROLE_API")
    //  * @ApiDoc(
    //  *   resource = true,
    //  *   description = "Updates a user from the submitted data by ID.",
    //  *   statusCodes = {
    //  *     200 = "Returned when successful",
    //  *     400 = "Returned when the form has errors"
    //  *   }
    //  * )
    //  *
    //  * @param ParamFetcher $paramFetcher Paramfetcher
    //  *
    //  * @RequestParam(name="id", nullable=false, strict=true, description="id.")
    //  * @RequestParam(name="username", nullable=true, strict=true, description="Username.")
    //  * @RequestParam(name="email", nullable=true, strict=true, description="Email.")
    //  * @RequestParam(name="name", nullable=true, strict=true, description="Name.")
    //  * @RequestParam(name="lastname", nullable=true, strict=true, description="Lastname.")
    //  * @RequestParam(name="password", nullable=true, strict=true, description="Plain Password.")
    //  *
    //  * @return View
    //  */
    // public function putUserAction(ParamFetcher $paramFetcher)
    // {
    //     $entity = $this->getDoctrine()->getRepository('AppBundle\Entity\User')->findOneBy(
    //         array('id' => $paramFetcher->get('id'))
    //     );
    //     $userManager = $this->container->get('fos_user.user_manager');
    //     $user = $userManager->findUserByUsername($entity->getUsername());
    //     if($paramFetcher->get('username')){ $user->setUsername($paramFetcher->get('username')); }
    //     if($paramFetcher->get('email')){$user->setEmail($paramFetcher->get('email')); }
    //     if($paramFetcher->get('password')){$user->setPlainPassword($paramFetcher->get('password')); }
    //     if($paramFetcher->get('name')){$user->setName($paramFetcher->get('name')); }
    //     if($paramFetcher->get('lastname')){$user->setLastname($paramFetcher->get('lastname')); }
    //     $view = View::create();
    //     $errors = $this->get('validator')->validate($user, array('Update'));
    //     if (count($errors) == 0) {
    //       $em = $this->getDoctrine()->getManager();
    //       $em->persist($task);
    //       $em->flush();
    //       $view->setData($task)->setStatusCode(201);
    //       return $view;
    //     } else {
    //       $view = $this->getErrorsView($errors);
    //       return $view;
    //     }
    // }
    // /**
    //  * Delete an user identified by username/email.
    //  *
    //  * @Secure(roles="ROLE_API")
    //  * @ApiDoc(
    //  *   resource = true,
    //  *   description = "Delete an user identified by username/email",
    //  *   statusCodes = {
    //  *     200 = "Returned when successful",
    //  *     404 = "Returned when the user is not found"
    //  *   }
    //  * )
    //  *
    //  * @param string $slug username or email
    //  *
    //  * @return View
    //  */
    // public function deleteUserAction($slug)
    // {
    //     $userManager = $this->container->get('fos_user.user_manager');
    //     $entity = $userManager->findUserByUsernameOrEmail($slug);
    //     if (!$entity) {
    //         throw $this->createNotFoundException('Data not found.');
    //     }
    //     $userManager->deleteUser($entity);
    //     $view = View::create();
    //     $view->setData("User deteled.")->setStatusCode(204);
    //     return $view;
    // }

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
