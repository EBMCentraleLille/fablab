<?php
/**
 * Created by God.
 * User: JunkOS
 * Date: 14/03/2016
 * Time: 09:20
 */

namespace CentraleLille\GdpBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Request\ParamFetcher;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\Validator\ConstraintViolationList;

class EventController extends GdpRestController
{
  /**
   * Return the overall event list.
   *
   * @ApiDoc(
   *   resource = true,
   *   description = "Return the overall Event List",
   *   statusCodes = {
   *     200 = "Returned when successful",
   *     404 = "Returned when there is no event"
   *   }
   * )
   *
   * @param int $id id
   *
   * @return View
   */
    public function getProjectEventsAction($id)
    {
        $eventRepository = $this->getDoctrine()->getRepository('ReservationBundle:Event');
        $list = $eventRepository->findByProject($id);
        if (!$list) {
            throw $this->createNotFoundException('Data not found.');
        }
        $this->existsProjectUser($id, $this->getUser()->getId());
        $view = View::create();
        $view->setData($list)->setStatusCode(200);
        return $view;
    }

    /**
     * Return an event.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Return a single event",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when no events are found"
     *   }
     * )
     *
     * @param int $id EventID
     *
     * @return View
     */
    public function getEventAction($eventId)
    {
        $eventRepository = $this->getDoctrine()->getRepository('ReservationBundle:Event');
        $event = $eventRepository->find($eventId);
        if (!$event) {
            throw $this->createNotFoundException('Data not found.');
        }
        $view = View::create();
        $view->setData($event)->setStatusCode(200);
        return $view;
    }

  /**
   * Create a Event from the submitted data.<br/>
   *
   * @ApiDoc(
   *   resource = true,
   *   description = "Creates a new event from the submitted data.",
   *   statusCodes = {
   *     201 = "Returned when successful",
   *     400 = "Returned when the form has errors"
   *   }
   * )
   *
   * @param int $id id
   *
   * @param ParamFetcher $paramFetcher Paramfetcher
   *
   * @RequestParam(name="title", nullable=false, strict=true, description="Title.")
   * @RequestParam(name="description", nullable=false, strict=true, description="Description.")
   * @RequestParam(name="startDateTime", nullable=false, strict=true, description="Date de début.")
   * @RequestParam(name="endDateTime", nullable=false, strict=true, description="Date de fin.")
   *
   * @return View
   */
    public function postProjectEventAction($id, ParamFetcher $paramFetcher)
    {
        $eventRepository = $this->getDoctrine()->getRepository('ReservationBundle:Event');
        $projectRepository = $this->getDoctrine()->getRepository('CustomFosUserBundle:Project');
        $project = $projectRepository->find($id);
        $this->existsProjectUser($id->getProject()->getId(), $this->getUser()->getId());
        $event = new Event();
        $event->setTitle($paramFetcher->get('title'));
        $event->setDescription($paramFetcher->get('description'));
        $event->setUser($this->getUser());
        $event->setCreationDateTime();
        $event->setStartDateTime($paramFetcher->get('startDateTime'));
        $event->setEndDateTime($paramFetcher->get('endDateTime'));
        $event->setProject($project);
        $view = View::create();
        $errors = $this->get('validator')->validate($event, array('Registration'));
        if (count($errors) == 0) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();
            $view->setData($event)->setStatusCode(201);
            return $view;
        } else {
            $view = $this->getErrorsView($errors);
            return $view;
        }
    }

  /**
   * Update a Event from the submitted data by ID.<br/>
   *
   * @ApiDoc(
   *   resource = true,
   *   description = "Updates an event from the submitted data by ID.",
   *   statusCodes = {
   *     200 = "Returned when successful",
   *     400 = "Returned when the form has errors"
   *   }
   * )
   *
   * @param int $eventId EventId
   *
   * @param ParamFetcher $paramFetcher Paramfetcher
   *
   * @RequestParam(name="title", nullable=false, strict=true, description="Title.")
   * @RequestParam(name="description", nullable=false, strict=true, description="Description.")
   * @RequestParam(name="startDateTime", nullable=false, strict=true, description="Date de début.")
   * @RequestParam(name="endDateTime", nullable=false, strict=true, description="Date de fin.")
   *
   * @return View
   */
    public function putEventAction($eventId, ParamFetcher $paramFetcher)
    {
        $event = $this->getDoctrine()->getRepository('ReservationBundle:Event')->findOneBy($eventId);
        $this->existsProjectUser($event->getProject()->getId(), $this->getUser()->getId());
        if ($paramFetcher->get('title')) {
            $event->setTitle($paramFetcher->get('title'));
        }
        if ($paramFetcher->get('description')) {
            $event->setDescription($paramFetcher->get('description'));
        }
        if ($paramFetcher->get('startDateTime')) {
            $event->setStartDateTime($paramFetcher->get('startDateTime'));
        }
        if ($paramFetcher->get('endDateTime')) {
            $event->setEndDateTime($paramFetcher->get('endDateTime'));
        }
        $view = View::create();
        $errors = $this->get('validator')->validate($event, array('Update'));
        if (count($errors) == 0) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();
            $view->setData($event)->setStatusCode(200);
            return $view;
        } else {
            $view = $this->getErrorsView($errors);
            return $view;
        }
    }

  /**
   * Delete an event identified by id.
   *
   * @ApiDoc(
   *   resource = true,
   *   description = "Delete an event identified by id",
   *   statusCodes = {
   *     200 = "Returned when successful",
   *     404 = "Returned when the event is not found"
   *   }
   * )
   *
   * @param int $eventId eventId
   *
   * @return View
   */
    public function deleteEventAction($eventId)
    {
        $repo = $this->getDoctrine()->getRepository('ReservationBundle:Event');
        $event = $repo->findOneBy(
            array('id' => $eventId)
        );
        $this->existsProjectUser($event->getProject()->getId(), $this->getUser()->getId());
        if (!$event) {
            throw $this->createNotFoundException('Data not found.');
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($event);
        $em->flush();
        $view = View::create();
        $view->setData("Event deteled.")->setStatusCode(200);
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
