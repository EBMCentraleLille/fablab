<?php

namespace CentraleLille\ReservationBundle\Event;

use ADesigns\CalendarBundle\Event\CalendarEvent;
use ADesigns\CalendarBundle\Entity\EventEntity;
use Doctrine\ORM\EntityManager;
use Proxies\__CG__\CentraleLille\ReservationBundle\Entity\Booking\Event;

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

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function loadEvents(CalendarEvent $calendarEvent)
    {
        $startDate = $calendarEvent->getStartDatetime();
        $endDate = $calendarEvent->getEndDatetime();

        $request = $calendarEvent->getRequest();
        $id = $request->get('id');
        //create some dummy event

        $id = '1';

        $em = $this->entityManager;
        $repository = $em->getRepository('ReservationBundle:Booking\Event');
        $resource = $repository ->find($id)->getBookable();
        $event = new \CentraleLille\ReservationBundle\Entity\Booking\Event();
        $event->setBookable($resource);
        $event->setStartDateTime(getdate());
        $event->setEndDateTime(getdate());



        $em->persist($event);


        // The original request so you can get filters from the calendar
        // Use the filter in your query for example




        // load events using your custom logic here,
        // for instance, retrieving events from a repository

        $companyEvents = $this->entityManager
            ->getRepository('ReservationBundle:Booking\Event')
            ->createQueryBuilder('event')
            ->where('event.bookable = :id')
            ->setParameter('id', $id)
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
                $eventEntity->setUrl('http://www.google.com'); // url to send user to when event label is clicked

            //finally, add the event to the CalendarEvent for displaying on the calendar
                $calendarEvent->addEvent($eventEntity);
        }
    }
}
