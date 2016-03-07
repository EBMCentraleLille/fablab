<?php
/**
 * FablabActivitiesInterface.php File Doc
 *
 * Interface du service FablabActivities en charge de la création et la récupératiob des activités par projet
 *
 * PHP Version 5.5
 *
 * @category FablabActivitesInterface
 * @package  NewsFeedBundle
 * @author   Corbière Charles <charles.corbiere@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/EBMCentraleLille/fablab
 */

namespace CentraleLille\NewsFeedBundle\ServicesInterfaces;


interface FablabAbonnementsInterface
{
	/**
    * creerActivitie
    *
    * Créer l'activité généré par un user sur un projet
    *
    * @param object $user Utilisateur
    * @param object $projet Projet
    * @param object $utype Type d'activité
    * @param object $content Contenu à afficher de l'activité
    *
    * @return object L'entité générée
    */

	public function creerActivite($user,$projet,$type,$content);


	/**
    * getActiProjet
    *
    * Retourne un tableau des activités d'un projet
    *
    * @param object $project Projet
    *
    * @return object Tableau d'activité du projet
    */

}