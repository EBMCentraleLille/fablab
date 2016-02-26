<?php

namespace CentraleLille\NewsFeedBundle\Abonnements;
use NewsFeedBundle\Entity\Abonnement;

class FablabAbonnements
{
	public function __construct(\Doctrine\ORM\EntityManager $entityManager)
	{
	    $this->em = $entityManager;
	}
	//ajoute l'abonnement d'un user à une categorie
	public function addCatAbo($user,$category){
		$abonnement=$this->em->getRepository("CentraleLilleNewsFeedBundle:Abonnement")
		if (! $abonnement->findBy(array('user'=>$user))){
			$abonnement = new Abonnement;
		}
		else{ 
			$abonnement=$abonnement->findBy(
				array('user'=>$user)
				);
		}
		$abonnement->addCategory($category);
		return $this;
	}
	//ajoute l'abonnement d'un user à un projet
	public function addProjAbo($user,$projet){
		$abonnement=$this->em->getRepository("CentraleLilleNewsFeedBundle:Abonnement")
		if (! $abonnement->findBy(array('user'=>$user))){
			$abonnement = new Abonnement;
		}
		else{ 
			$abonnement=$abonnement->findBy(
				array('user'=>$user)
				);
		}
		$abonnement->addProject($projet);
		return $this;
	}
	//retourne un tableau des catégories auxquelles est abonné un user
	public function getCatAbo($user){
		$repository=$this->em->getRepository("CentraleLilleNewsFeedBundle:Abonnement");
		$abonnement=$repository->findBy(
			array('user'=>$user)
	        );
		return $abonnement->getCategories;
	}

	//retourne un tableau des projets auxquels est abonné un user
	//sans les projets des catégories auxquelles il est abonné
	public function getProjAbo($user){
		$repository=$this->em->getRepository("CentraleLilleNewsFeedBundle:Abonnement");
		$abonnement=$repository->findBy(
			array('user'=>$user)
	        );
		return $abonnement->getProjects;
	}
	//retourne un tableaux des projets auxquels est abonné un utilisateurs,
	//y compris ceux des catégories auxquelles il est abonné
	public function getAllAbo($user){
		$categories=$this->getCatAbo($user);
		$aboProjets=$this->getProjAbo($user);

		/* à compléter*/

		return $aboProjets;
	}
	//ajoute l'abonnement d'un user à une categorie
	public function removeCatAbo($user,$category){
		$abonnement=$this->em->getRepository("CentraleLilleNewsFeedBundle:Abonnement")>findBy(
				array('user'=>$user)
				);		
		$abonnement->removeCategory($category);
		return $this;
	}
	//ajoute l'abonnement d'un user à un projet
	public function removeProjAbo($user,$projet){
		$abonnement=$this->em->getRepository("CentraleLilleNewsFeedBundle:Abonnement")>findBy(
				array('user'=>$user)
				);		
		$abonnement->removeProject($projet);
		return $this;
	}
}