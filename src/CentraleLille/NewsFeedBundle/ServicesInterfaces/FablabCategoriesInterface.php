<?php
/**
 * FablabCategoriesInterface.php Doc
 *
 * Interface relatif aux Categories
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
 * FablabCategoriesnterface Interface Doc
 *
 * Interface pour gérer les catégories des projets
 *
 * @category   Interface
 * @package    CentraleLille:NewsFeedBundle
 * @subpackage ServicesInterfaces
 * @author     Lechaptois Martin <martin.lechaptois@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link       https://github.com/EBMCentraleLille/fablab
 */
interface FablabCategoriesInterface
{
    /**
     * Crée une catégorie
     *
     * @param array $categoryName nom de la catégorie
     *
     * @return void
     */
    public function addCategory($categoryName);

    /**
     * Crée une catégorie
     *
     * @param array $categoryName nom de la catégorie
     * @param array $project      Entité Projet à ajouter à la catégorie
     *
     * @return void
     */
    public function addProjectCategory($categoryName, $project);

    /**
     * Recherche tous les noms des catégories et ne renvoie que les $nb premières
     *
     * @param integer $nb nombre de categories recherchées
     *
     * @return array $categories Tableau de toutes les catégories
     */
    public function getCategories($nb);

    /**
     * Retourne un tableau des projets d'une catégorie
     *
     * @param string $categoryName Nom de la catégorie
     *
     * @return array $projectsCategory Tableau des projets relatifs à la catgégorie
     */
    public function getProjectsCategory($categoryName);

    /**
     * Retourne un tableau des users abonnés à une catégorie
     *
     * @param string $categoryName Nom de la catégorie
     *
     * @return array $usersCategory Tableau des users abonnés à la catgégorie
     */
    public function getUsersCategory($categoryName);

    /**
     * Supprime une catégorie
     *
     * @param string $categoryName Nom de la catégorie à supprimer
     *
     * @return void
     */
    public function removeCategory($categoryName);

    /**
     * Supprime un projet d'une catégorie
     *
     * @param string $categoryName Nom de la catégorie
     * @param array  $projet       Entité Projet à supprimer de la catégorie
     *
     * @return void
     */
    public function removeProjectCategory($categoryName, $projet);
}
