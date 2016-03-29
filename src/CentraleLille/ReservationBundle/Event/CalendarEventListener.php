<?php

namespace CentraleLille\ReservationBundle\Event;

use ADesigns\CalendarBundle\Event\CalendarEvent;
use ADesigns\CalendarBundle\Entity\EventEntity;
use CentraleLille\CustomFosUserBundle\Entity\Project;
use CentraleLille\ReservationBundle\Entity\Bookables\Machine;
use CentraleLille\ReservationBundle\Entity\Booking\Strategy\BookMachine;
use CentraleLille\ReservationBundle\Entity\Booking\BookManager;
use CentraleLille\ReservationBundle\Entity\Booking\Strategy\BookStrategy;
use Doctrine\ORM\EntityManager;
use CentraleLille\ReservationBundle\Entity\Booking\Event;
use Symfony\Component\HttpFoundation\RequestStack;
use CentraleLille\CustomFosUserBundle\Entity\User;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Event Class Doc
 *
 * Calendar event listener
 *
 * @category Controller
 * @package  Reservation Bundle
 * @author   Pierre-Louis Bonnart <plbonnart@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/pierloui/fablab
 */

class CalendarEventListener
{
    private $entityManager;
    private $requestStack;
    private $user;

    public function __construct(EntityManager $entityManager, RequestStack $requestStack)
    {
        $this->entityManager = $entityManager;
        $this->requestStack = $requestStack;
    }

    public function loadEvents(CalendarEvent $calendarEvent)
    {
        $request = $calendarEvent->getRequest();

        $title = $request->get('title');
        $description = $request->get('description');
        $start = $request->get('start');
        $end = $request->get('end');
        $userId = $request->get('userId');

        $idMachine = $request->get('machineId');

        if ($title && $description && $start && $end && $userId) {
            //converting unix timestamp from ms to s (because javascript provide ms)
            $start = \DateTime::createFromFormat('U', $start/1000);
            $end = \DateTime::createFromFormat('U', $end/1000);

            $em = $this->entityManager;
            $repository = $em->getRepository('ReservationBundle:Bookables\Machine');
            $resource = $repository ->find($idMachine);

            $repository = $em->getRepository('CustomFosUserBundle:User');
            $user = $repository->find($userId);
            //$project = new Project();

            $event = new \CentraleLille\ReservationBundle\Entity\Booking\Event();

            $event->setBookable($resource);
            $event->setTitle($title);
            $event->setDescription($description);
            $time = new \DateTime('now');
            $event->setCreationDateTime($time);
            $event->setStartDateTime($start);
            $event->setEndDateTime($end);
            $event->setStatus('');
            //$event->setUser($user);

            //$booker = new BookManager(new BookMachine($em));
            //$booker->getBookStrategy()->book($user, $project, $start, $end, $resource);

            $em->persist($event);
            $em->flush();
        }


        // The original request so you can get filters from the calendar
        // Use the filter in your query for example


        // load events using your custom logic here,
        // for instance, retrieving events from a repository

        $companyEvents = $this->entityManager
            ->getRepository('ReservationBundle:Booking\Event')
            ->createQueryBuilder('event')
            ->where('event.bookable = :id')
            ->setParameter('id', $idMachine)
            ->getQuery()->getResult();

        // $companyEvents and $companyEvent in this example
        // represent entities from your database, NOT instances of EventEntity
        // within this bundle.
        //
        // Create EventEntity instances and populate it's properties with data
        // from your own entities/database values.

        foreach ($companyEvents as $companyEvent) {

            // create an event with a start/end time, or an all day event

            $eventEntity = new EventEntity(
                $companyEvent->getTitle(),
                $companyEvent->getStartDatetime(),
                $companyEvent->getEndDatetime(),
                false
            );

            //optional calendar event settings
                $eventEntity->setBgColor('#FF0000'); //set the background color of the event's label
                $eventEntity->setFgColor('#FFFFFF'); //set the foreground color of the event's label
                $eventEntity->setUrl('#'); // url to send user to when event label is clicked

            //finally, add the event to the CalendarEvent for displaying on the calendar
                $calendarEvent->addEvent($eventEntity);
        }
    }
}
