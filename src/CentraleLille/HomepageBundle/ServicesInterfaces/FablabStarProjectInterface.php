<?php
/**
 * FablabStarProjectInterface.php Doc
 *
 * Interface relatif aux projets "star"
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
namespace CentraleLille\HomepageBundle\ServicesInterfaces;

/**
 * FablabStarProjectInterface Interface Doc
 *
 * Interface pour gérer les projets "star"
 *
 * @category   Interface
 * @package    CentraleLille:NewsFeedBundle
 * @subpackage ServicesInterfaces
 * @author     Lechaptois Martin <martin.lechaptois@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link       https://github.com/EBMCentraleLille/fablab
 */
interface FablabStarProjectInterface
{
    /**
     * Ajoute un star project
     *
     * @param integer $projectId Entité Projet
     * @param string  $content   Text associé au star project
     *
     * @return void
     */
    public function addStarProject($projectId, $content);

    /**
     * Modifie un star project
     *
     * @param array  $project Entité Projet
     * @param string $content Text associé au star project
     *
     * @return void
     */
    public function modifyStarProject($project, $content);
    
    /**
     * Retourne tous les star projects
     *
     * @return array $starProjects Array d'entités StarProject
     */
    public function getAllStarProjects();

    /**
     * Retourne un ou plusieurs star projects
     *
     * @param integer $limit Nombre de star projets retournés
     *
     * @return void
     */
    public function getStarProjects($limit);

    /**
     * Supprime un star project
     *
     * @param integer $starProjectId id StarProject
     *
     * @return void
     */
    public function removeStarProject($starProjectId);
}
