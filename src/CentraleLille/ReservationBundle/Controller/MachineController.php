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

use CentraleLille\ReservationBundle\Entity\Machine;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
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
            ->add('machineName', 'text')
            ->add('description', 'textarea')
            ->add('Sauvegarder', 'submit');

        $form = $formBuilder->getForm();
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($machine);
            $em->flush();
            return $this->redirect(
                $this->generateUrl(
                    'centrale_lille_add_machine',
                    array('prenom'=>'Michelle','nom'=>'Jean', 'form'=> $form->createView())
                )
            );
        }

        return $this->render(
            'ReservationBundle::add.html.twig',
            array('prenom'=>'Michelle','nom'=>'Jean','form' => $form->createView())
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
        $repository = $em->getRepository('ReservationBundle:Machine');

        $machine = $repository ->find($id);

        $em->remove($machine);
        $em->flush();
        return $this->redirect(
            $this->generateUrl(
                'centrale_lille_administration',
                array('prenom'=>'Michelle', 'nom'=>'Jean')
            )
        );
    }
}
