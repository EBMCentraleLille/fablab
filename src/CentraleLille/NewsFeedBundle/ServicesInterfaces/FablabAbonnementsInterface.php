<?php

namespace CentraleLille\NewsFeedBundle\ServicesInterfaces;


interface FablabAbonnementsInterface
{
	
	//ajoute l'abonnement d'un user à une categorie
	public function addAboCategory($user,$category);		
	
	//ajoute l'abonnement d'un user à un projet
	public function addAboProjet($user,$projet);

	//retourne un tableau des catégories auxquelles est abonné un user
	public function getAboCategory($user);

	//retourne un tableau des projets auxquels est abonné un user
	//sans les projets des catégories auxquelles il est abonné
	public function getAboProjet($user);

	//retourne un tableaux des projets auxquels est abonné un utilisateurs,
	//y compris ceux des catégories auxquelles il est abonné
	public function getAboAll($user);

	//ajoute l'abonnement d'un user à une categorie
	public function removeAboCategory($user,$category);

	//ajoute l'abonnement d'un user à un projet
	public function removeAboProjet($user,$projet);

}