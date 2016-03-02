<?php
/**
 * AbonnementRepository.php Doc
 * 
 * Services relatif aux abonnements permettant l'accès et la modification
 * aux données d'abonnements relatives à un user
 *
 * PHP Version 5.6
 *
 * @package  	CentraleLille
 * @subpackage 	NewsFeedBundle
 * @category 	Service
 * @author   	Lechaptois Martin <martin.lechaptois@gmail.com>
 * @license  	http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     	https://github.com/EBMCentraleLille/fablab
 */

namespace CentraleLille\NewsFeedBundle\Services;

use CentraleLille\NewsFeedBundle\Entity\Abonnement;
use CentraleLille\DemoBundle\Entity\Projet;
use CentraleLille\NewsFeedBundle\ServicesInterfaces\FablabAbonnementsInterface;

/**
 *  FablabAbonnements service Class Doc
 *  
 */
class FablabAbonnements implements FablabAbonnementsInterface
{
	/**
	 *
	 * fonction construct de la class
	 * 
	 * @param \Doctrine\ORM\EntityManager
	 */
	public function __construct(\Doctrine\ORM\EntityManager $entityManager)
	{
	    $this->em = $entityManager;
	}
	
	//
	/**
	 *
	 * ajoute l'abonnement d'un user à une categorie
	 * 
	 * @param array $user
	 * @param array $category
	 *
	 * @return  void
	 */
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
	/**
	 * ajoute l'abonnement d'un user à un projet
	 * 
	 * @param array $user
	 * @param array $projet
	 *
	 * @return  void
	 */
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
	/**
	 * retourne un tableau des catégories auxquelles est abonné un user
	 * 
	 * @param  array $user
	 * 
	 * @return array $categories
	 */
	public function getAboCategory($user){
		$repository=$this->em->getRepository("CentraleLilleNewsFeedBundle:Abonnement");
		$abonnement=$repository->findOneBy(
			array('user'=>$user)
	        );
		return $abonnement->getCategories();
	}
	/**
	 * retourne un tableau des projets auxquels est abonné un user
	 * sans les projets des catégories auxquelles il est abonné
	 * 
	 * @param  array $user
	 * 
	 * @return array $projets
	 */
	public function getAboProjet($user){
		$repository=$this->em->getRepository("CentraleLilleNewsFeedBundle:Abonnement");
		$abonnement=$repository->findOneBy(
			array('user'=>$user)
	        );
		return $abonnement->getProjects();
	}
	
	/**
	 * retourne un tableaux des projets auxquels est abonné un utilisateurs,
	 * y compris ceux des catégories auxquelles il est abonné
	 * 
	 * @param  array $user
	 * 
	 * @return array $projets
	 */
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
	
	/**
	 * ajoute l'abonnement d'un user à une categorie
	 * 
	 * @param  array $user
	 * @param  array $category
	 * 
	 * @return void
	 */
	public function removeAboCategory($user,$category){
		$abonnement=$this->em->getRepository("CentraleLilleNewsFeedBundle:Abonnement")->findOneBy(
				array('user'=>$user)
				);		
		$abonnement->removeCategory($category);
		$this->em->persist($abonnement);
      	$this->em->flush();
		return $this;
	}
	
	/**
	 *
	 * ajoute l'abonnement d'un user à un projet
	 * 
	 * @param  array $user
	 * @param  array $projet
	 * 
	 * @return void
	 */
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