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

use CentraleLille\ReservationBundle\Entity\Bookables\Machine;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Controller Class Doc
 *
 * Contrôleur associé au type machine
 *
 * @category Controller
 * @package  Reservation Bundle
 * @author   Skikar El Mehdi <skikar.elmehdi@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/pierloui/fablab
 */

class MachineController extends Controller
{

    /**
     * addMachineAction
     *
     * Génère un formulaire permettant de rajouter une machine
     *
     * @param  Request $request Récupère les données envoyés en POST
     *      *
     * @return Redirect
     */

    public function addMachineAction(Request $request)
    {
        $machine = new Machine();

        $formBuilder = $this->get('form.factory')->createBuilder('form', $machine);

        $formBuilder
            ->add('name', 'text')
            ->add('description', 'textarea')
            ->add('type', 'entity', array(
                    'class'=>'ReservationBundle:Bookables\Type',
                    'choice_label'=>'name',
                    'required'=>true
            ))
            ->add('statut', ChoiceType::class, [
                'choices'=>array(
                    'Disponible'=>'Disponible',
                    'Indisponible'=>'Indisponible',
                    'Hors Service'=>'Hors Service',
                    'En Test'=>'En Test'
                ),
                'choices_as_values'=>true
                ])
            ->add('Sauvegarder', 'submit');

        $form = $formBuilder->getForm();
        $form->handleRequest($request);

        if ($form->isValid() && $machine != null) {
            $this ->addFlash('notice', 'La machine '.$machine->getName().' a bien été enregistré !');
            $em = $this->getDoctrine()->getManager();
            $em->persist($machine);
            $em->flush();
            $machine = new Machine();
            return $this->redirect(
                $this->generateUrl(
                    'centrale_lille_add_machine'
                )
            );
        }

        return $this->render(
            'ReservationBundle::add.html.twig',
            array('form' => $form->createView())
        );
    }


    /**
     * deleteMachineAction
     *
     * Génère un formulaire permettant de supprimer une machine
     *
     * @param integer $id Id de la machine à supprimer reçu dans l'URL
     *
     * @return Redirect
     */

    public function deleteMachineAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('ReservationBundle:Bookables\Machine');
        $repository_event = $em->getRepository('ReservationBundle:Booking\Event');
        $machine = $repository ->find($id);
        $events = $repository_event->findByBookable($machine);

        foreach ($events as $event) {
            $em->remove($event);
        }

        $em->remove($machine);
        $em->flush();
        return $this->redirect(
            $this->generateUrl(
                'centrale_lille_administration'
            )
        );
    }
}
