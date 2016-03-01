<?php

namespace CentraleLille\NewsFeedBundle\Services;

use CentraleLille\NewsFeedBundle\Entity\Activity;
use CentraleLille\NewsFeedBundle\ServicesInterfaces\FablabActivitiesInterface;

class FablabActivities implements FablabActivitiesInterface
{
	public function __construct(\Doctrine\ORM\EntityManager $entityManager)
	{
	    $this->em = $entityManager;
	}

	
	// Créer l'activité généré par un user sur un projet
	public function creerActivite($user,$projet,$type,$content){
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


	// Retourne un tableau des activités d'un projet
	public function getActiProjet($projet){
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