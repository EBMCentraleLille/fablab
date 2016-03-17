<?php

namespace CentraleLille\ReservationBundle\Event;

use ADesigns\CalendarBundle\Event\CalendarEvent;
use ADesigns\CalendarBundle\Entity\EventEntity;
use Doctrine\ORM\EntityManager;

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
        //$machineId = $calendarEvent->getStartDatetime();
        //$machineId = '2';

        // The original request so you can get filters from the calendar
        // Use the filter in your query for example

        $request = $calendarEvent->getRequest();
        $machineId = $request->get('machineId');


        // load events using your custom logic here,
        // for instance, retrieving events from a repository

        $companyEvents = $this->entityManager
            ->getRepository('ReservationBundle:Event')
            ->createQueryBuilder('event')
            ->where('event.machine = :machineId')
            ->setParameter('machineId', $machineId)
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
                    (string) $companyEvent->getMachine(),
                    $companyEvent->getStartDatetime(),
                    $companyEvent->getEndDatetime()
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
