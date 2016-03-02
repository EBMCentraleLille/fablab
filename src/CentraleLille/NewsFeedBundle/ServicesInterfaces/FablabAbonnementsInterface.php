<?php
/**
 * AbonnementRepository.php Doc
 * 
 * Interface relatif aux abonnements
 *
 * PHP Version 5.6
 *
 * @package  	CentraleLille
 * @subpackage 	NewsFeedBundle
 * @category 	ServiceInterface
 * @author   	Lechaptois Martin <martin.lechaptois@gmail.com>
 * @license  	http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     	https://github.com/EBMCentraleLille/fablab
 */
namespace CentraleLille\NewsFeedBundle\ServicesInterfaces;

/**
 * FablabAbonnementsInterface Interface Doc
 */
interface FablabAbonnementsInterface
{
	
	//ajoute l'abonnement d'un user à une categorie
	

	/**
	 * @param array $user
	 * @param array $category
	 * @return void
	 */
	public function addAboCategory($user,$category){};		
	
	/**
	 *
	 * ajoute l'abonnement d'un user à un projet
	 * 
	 * @param array $user
	 * @param array $projet
	 * @return  void
	 */
	public function addAboProjet($user,$projet);

	/**
	 * retourne un tableau des catégories auxquelles est abonné un user
	 * 
	 * @param  array $user
	 * @return void
	 */
	public function getAboCategory($user);

	/**
	 * retourne un tableau des projets auxquels est abonné un user
	 * sans les projets des catégories auxquelles il est abonné
	 * 
	 * @param  array $user
	 * @return void
	 */
	public function getAboProjet($user);

	/**
	 * retourne un tableaux des projets auxquels est abonné un utilisateurs,
	 * y compris ceux des catégories auxquelles il est abonné
	 * 
	 * @param  array $user
	 * @return void
	 */
	public function getAboAll($user);
	
	/**
	 * ajoute l'abonnement d'un user à une categorie
	 * 
	 * @param  array $user
	 * @param  array $category
	 * @return void
	 */
	public function removeAboCategory($user,$category);

	/**
	 *
	 * ajoute l'abonnement d'un user à un projet
	 * 
	 * @param  array $user
	 * @param  array $projet
	 */
	public function removeAboProjet($user,$projet);

}