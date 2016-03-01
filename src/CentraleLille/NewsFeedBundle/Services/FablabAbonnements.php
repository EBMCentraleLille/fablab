<?php

namespace CentraleLille\NewsFeedBundle\Services;

use CentraleLille\NewsFeedBundle\Entity\Abonnement;
use CentraleLille\DemoBundle\Entity\Projet;
use CentraleLille\NewsFeedBundle\ServicesInterfaces\FablabAbonnementsInterface;

class FablabAbonnements implements FablabAbonnementsInterface
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
		$projets=[];
		$abonnement=$this->em->getRepository("CentraleLilleNewsFeedBundle:Abonnement")->findOneBy(
			array('user'=>$user)
	        );
		$aboCategories=$this->getAboCategory($user);
		$aboProjets=$this->getAboProjet($user);
		foreach ($aboProjets as $aboProjet){
			array_push($projets, $aboProjet->getId());
		}
		
		foreach ($aboCategories as $aboCategory) {
			$projetsCat=$this->em->getRepository('CentraleLilleNewsFeedBundle:Category')->findOneBy(
				array('name'=>$aboCategory->getName())
				)->getProjets();
			foreach ($projetsCat as $projetCat) {
				if(! in_array($projetCat->getId(), $projets)){
					array_push($projets, $projetCat->getId());
				}
			}
		}

		return $projets;
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