<?php

namespace CentraleLille\NewsFeedBundle\Abonnements;
use CentraleLille\NewsFeedBundle\Entity\Abonnement;

class FablabAbonnements
{
	public function __construct(\Doctrine\ORM\EntityManager $entityManager)
	{
	    $this->em = $entityManager;
	}
	//ajoute l'abonnement d'un user à une categorie
	public function addAboCategory($user,$category){
		$abonnement=$this->em->getRepository("CentraleLilleNewsFeedBundle:Abonnement");
		if (! $abonnement->findOneBy(array('user'=>$user))){
			$abonnement = new Abonnement;
			$abonnement->setUser($user);
			$abonnement->setCategories($category);
		}
		else{ 
			$abonnement=$abonnement->findOneBy(
				array('user'=>$user)
				);
			$abonnement->addCategory($category);
		}
		
		$this->em->persist($abonnement);
      	$this->em->flush();
		return $this;
	}
	//ajoute l'abonnement d'un user à un projet
	public function addAboProjet($user,$projet){
		$abonnement=$this->em->getRepository("CentraleLilleNewsFeedBundle:Abonnement");
		if (! $abonnement->findOneBy(array('user'=>$user))){
			$abonnement = new Abonnement;
			$abonnement->setUser($user);
			$abonnement->setProjects($projet);
		}
		else{ 
			$abonnement=$abonnement->findOneBy(
				array('user'=>$user)
				);
			$abonnement->addProject($projet);
		}
		$this->em->persist($abonnement);
      	$this->em->flush();
		
		return $this;
	}
	//retourne un tableau des catégories auxquelles est abonné un user
	public function getAboCategory($user){
		$repository=$this->em->getRepository("CentraleLilleNewsFeedBundle:Abonnement");
		$abonnement=$repository->findOneBy(
			array('user'=>$user)
	        );
		return $abonnement->getCategories();
	}

	//retourne un tableau des projets auxquels est abonné un user
	//sans les projets des catégories auxquelles il est abonné
	public function getAboProjet($user){
		$repository=$this->em->getRepository("CentraleLilleNewsFeedBundle:Abonnement");
		$abonnement=$repository->findOneBy(
			array('user'=>$user)
	        );

		return $abonnement->getProjects();
	}
	//retourne un tableaux des projets auxquels est abonné un utilisateurs,
	//y compris ceux des catégories auxquelles il est abonné
	public function getAboAll($user){
		$repository=$this->em->getRepository("CentraleLilleNewsFeedBundle:Abonnement");
		$abonnement=$repository->findOneBy(
			array('user'=>$user)
	        );
		$categories=$this->getCatAbo($user);
		$aboProjets=$this->getProjAbo($user);

		/* à compléter*/

		return $aboProjets;
	}
	//ajoute l'abonnement d'un user à une categorie
	public function removeAboCategory($user,$category){
		$abonnement=$this->em->getRepository("CentraleLilleNewsFeedBundle:Abonnement")->findOneBy(
				array('user'=>$user)
				);		
		$abonnement->removeCategory($category);
		$this->em->persist($abonnement);
      	$this->em->flush();
		return $this;
	}
	//ajoute l'abonnement d'un user à un projet
	public function removeAboProjet($user,$projet){

		$abonnement=$this->em->getRepository("CentraleLilleNewsFeedBundle:Abonnement")->findOneBy(
				array('user'=>$user)
				);
		$abonnement->removeProject($projet);
		$this->em->persist($abonnement);
      	$this->em->flush();
		return $this;
	}
}