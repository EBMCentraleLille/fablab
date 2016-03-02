<?php
/**
 * FablabActivities.php File Doc
 *
 * Service en charge de la création et la récupératiob des activités par projet
 *
 * PHP Version 5.5
 *
 * @category FablabActivites
 * @package  NewsFeedBundle
 * @author   Corbière Charles <charles.corbiere@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/EBMCentraleLille/fablab
 */

namespace CentraleLille\NewsFeedBundle\Services;

use CentraleLille\NewsFeedBundle\Entity\Activity;
use CentraleLille\NewsFeedBundle\ServicesInterfaces\FablabActivitiesInterface;

/**
 * FablabActivities Class Doc
 *
 * Service de gestion des activités
 *
 * @category FablabActivites
 * @package  NewsFeedBundle
 * @author   Corbière Charles <charles.corbiere@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/EBMCentraleLille/fablab
 */

class FablabActivities implements FablabActivitiesInterface
{

	public function __construct(\Doctrine\ORM\EntityManager $entityManager)
	{
        /**
         * __construct
         *
         * Constructeur du service FablabActivities
         *
         * @return Response Une entité crée
         */

	    $this->em = $entityManager;
	}

	
	public function creerActivite($user,$projet,$type,$content)
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
        * @return Response L'entité générée
        */

		$date = new \DateTime()
		
		$activity=$this->em->getRepository("CentraleLilleNewsFeedBundle:Activity");
		$activity = new Activity;
		$activity->setDate($date);
		$activity->setUser($user);
		$activity->setProjet($projet);
		$activity->setType($type);
		$activity->setContent($content);

		$this->em->persist($activity);
      	$this->em->flush();
		return $this;


	public function getActiProjet($projet)
	{
		/**
        * getActiProjet
        *
        * Retourne un tableau des activités d'un projet
        *
        * @param object $project Projet
        *
        * @return Response Tableau d'activité du projet
        */

		$repository=$this->em->getRepository("CentraleLilleNewsFeedBundle:Activity");
		$activities=$repository->findBy(
			array('projet'=>$projet),   // Critere
			array('date'=>'desc'),      // Tri par date décroissant
			20,                         // Selection de 20 activité seulement
			0                           // A partir de la première
	        );
		return $activities;
	}
}