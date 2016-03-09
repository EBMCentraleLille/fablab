<?php
/**
 * ProjectPageController.php File Doc
 *
 * Controller permettant l'affichage de la page d'un projet sur la route /projet/{projectId}
 *
 * PHP Version 5.5
 *
 * @category ProjectPageController
 * @package  ProjectPageBundle
 * @author   Hyot James <james.hyot@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/EBMCentraleLille/fablab
 */

namespace CentraleLille\ProjectPageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**

 * ProjectPageController Class Doc
 *
 * Controller d'affichage d'un projet
 *
 * @category ProjectPageController
 * @package  ProjectPageBundle
 * @author   Hyot James <james.hyot@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/EBMCentraleLille/fablab
 */

class ProjectPageController extends Controller
{
    public function displayProjectAction($projectId)
    {
        /**
         * displayProjectAction
         *
         * Affiche une page projet en utilisant l'ID du projet et en supposant récupérer les données du
         * projet grâce à un service
         *
         * @param String $projectId Id unique de projet, attribué à la création par le groupe Projet
         *
         * @return Response Une réponse à afficher
         */

        return $this->render('ProjectPageBundle:Default:projectpage.html.twig', array(
                'projectId' => $projectId));
    }

    public function wrongProjectAction()
    {
        /**
         * wrongProjectAction
         *
         * Affiche une page d'erreur si l'on tente d'accéder à l'URL /project/ sans Id projet
         *
         * @param
         *
         * @return Response Une réponse à afficher
         */

        return $this->render('ProjectPageBundle:Default:wrongpage.html.twig');
    }
}
