<?php
/**
 * FablabAbonnementsInterface.php Doc
 *
 * Interface relatif aux abonnements
 *
 * PHP Version 5.6
 *
 * @category   File
 * @package    CentraleLille:NewsFeedBundle
 * @subpackage ServicesInterfaces
 * @author     Lechaptois Martin <martin.lechaptois@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link       https://github.com/EBMCentraleLille/fablab
 */
namespace CentraleLille\NewsFeedBundle\ServicesInterfaces;

/**
 * FablabAbonnementsInterface Interface Doc
 *
 * Interface pour gérer les abonnements utilisateurs
 *
 * @category   Interface
 * @package    CentraleLille:NewsFeedBundle
 * @subpackage ServicesInterfaces
 * @author     Lechaptois Martin <martin.lechaptois@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link       https://github.com/EBMCentraleLille/fablab
 */
interface FablabAbonnementsInterface
{
    /**
     * Ajoute l'abonnement d'un user à une categorie
     *
     * @param array $user     Entité User
     * @param array $category Entité Category
     *
     * @return void
     */
    public function addAboCategory($user, $category);
    
    /**
     * Ajoute l'abonnement d'un user à un projet
     *
     * @param array $user   Entité User
     * @param array $projet Entité Projet
     *
     * @return void
     */
    public function addAboProjet($user, $projet);

    /**
     * Retourne un tableau des catégories auxquelles est abonné un user
     *
     * @param array $user Entité User
     *
     * @return void
     */
    public function getAboCategory($user);

    /**
     * Retourne un tableau des projets auxquels est abonné un user
     * sans les projets des catégories auxquelles il est abonné
     *
     * @param array $user Entité User
     *
     * @return void
     */
    public function getAboProjet($user);

    /**
     * Retourne un tableaux des projets auxquels est abonné un utilisateurs,
     * y compris ceux des catégories auxquelles il est abonné
     *
     * @param array $user Entité User
     *
     * @return void
     */
    public function getAboAll($user);
    
    /**
     * Permet de savoir si un user est déja abonné à un projet
     *
     * @param array $user   Entité User
     * @param array $projet Entité Projet
     *
     * @return void
     */
    public function isAboProjet($user, $projet);

    /**
     * Permet de savoir si un user est déja abonné à une catégorie
     *
     * @param array $user     Entité User
     * @param array $category Entité Category
     *
     * @return void
     */
    public function isAboCategory($user, $category);
    
    /**
     * Ajoute l'abonnement d'un user à une categorie
     *
     * @param array $user     Entité User
     * @param array $category Entité Category
     *
     * @return void
     */
    public function removeAboCategory($user, $category);

    /**
     * Ajoute l'abonnement d'un user à un projet
     *
     * @param array $user   Entité User
     * @param array $projet Entité Projet
     *
     * @return void
     */
    public function removeAboProjet($user, $projet);
}
