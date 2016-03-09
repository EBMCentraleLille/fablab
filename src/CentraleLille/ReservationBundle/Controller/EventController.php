<?php

/**
 * PHP Version 5.5
 *
 * @Category Controller
 * @Package  Reservation
 * @author   Skikar El Mehdi <skikar.elmehdi@gmail.com>
 * @Licence  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @Link     https://github.com/pierloui/fablab
 */

namespace CentraleLille\ReservationBundle\Controller;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use CentraleLille\ReservationBundle\Entity\Event;
use CentraleLille\ReservationBundle\Entity\Machine;
use Symfony\Component\HttpFoundation\Request;

/**
 * Controller Class Doc
 *
 * Contrôleur associé au type Event
 *
 * @category Controller
 * @package  Reservation Bundle
 * @author   Skikar El Mehdi <skikar.elmehdi@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/pierloui/fablab
 */

class EventController extends Controller
{
    /**
     * reserverAction
     *
     * Génère un formulaire permettant de réserver une machine à une date donnée
     *
     * @param  Request $request Récupère les données envoyés en POST
     *      *
     * @return Redirect
     */

    public function reserverAction(Request $request)
    {
        $event = new Event();
        $event->setCreationDateTime();
        $formBuilder = $this->get('form.factory')->createBuilder('form', $event);

        $formBuilder->add(
            'startDateTime',
            'datetime',
            array(

            'placeholder' => array(
                'year' => 'Année', 'month' => 'Mois', 'day' => 'Jour', 'hour' => 'Heure', 'minute' => 'Minute',
            ))
        )
            ->add(
                'endDateTime',
                'datetime',
                array(
                'placeholder'=> array(
                    'year'=>'Année','month'=> 'Mois', 'day'=> 'Jour',
                    'hour'=>'Heure','minute'=>'Minute',
                ))
            )
            ->add(
                'machine',
                EntityType::class,
                array(
                'class' => 'ReservationBundle:Machine',
                'choice_label' => 'machineName',
                'multiple' => false,
                'required' => true,
                'expanded' => true)
            )
            ->add('sauvegarder', 'submit');


            $form = $formBuilder->getForm();

            $form->handleRequest($request);

        if ($form->isSubmitted() && $request->isMethod("POST")) {

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($event);
                $em->flush();
                $event = new Event();
                $formBuilder = $this->get('form.factory')->createBuilder('form', $event);
                $formBuilder->add(
                    'startDateTime',
                    'datetime',
                    array(
                    'placeholder' => array(
                        'year' => 'Année', 'month' => 'Mois', 'day' => 'Jour', 'hour' => 'Heure', 'minute' => 'Minute',
                    ))
                )
                    ->add(
                        'endDateTime',
                        'datetime',
                        array(
                        'placeholder'=> array(
                            'year'=>'Année','month'=> 'Mois', 'day'=> 'Jour',
                            'hour'=>'Heure','minute'=>'Minute',
                        ))
                    )
                    ->add(
                        'machine',
                        EntityType::class,
                        array(

                        'class' => 'ReservationBundle:Machine',
                        'choice_label' => 'machineName',
                        'multiple' => false,
                        'required' => true,

                        'expanded' => true)
                    )

                    ->add('sauvegarder', 'submit');

                $form = $formBuilder ->getForm();

                return $this->render(
                    'ReservationBundle::reservation.html.twig',
                    array('nom'=>"Michelle",'prenom'=>'Jean','form'=> $form->createView())
                );
            }
        }

            return $this->render(
                'ReservationBundle::reservation.html.twig',
                array('nom' => 'Michelle', 'prenom' => 'Jean', 'form' => $form->createView())
            );

    }

    /**
     * adminAction
     *
     * Fonction permettant de lister les machines afin de donner la possibilité de supprimer / modifier à l'admin
     *
     * @return Response
     */

    public function adminAction()
    {
        $em = $this->getDoctrine()->getManager();

        $repository = $em->getRepository('ReservationBundle:Machine');

        $machines = $repository->findAll();


        return $this->render(
            'ReservationBundle::admin.html.twig',
            array('prenom'=>'Michelle','nom'=>'Jean','machines'=>$machines)
        );
    }
}
