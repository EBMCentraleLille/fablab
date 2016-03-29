<?php
/**
 * FablaRecentProjectInterface.php Doc
 *
 * Interface relatif aux projets récents
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
 * FablaRecentProjectInterface Interface Doc
 *
 * Interface pour gérer les projets récents
 *
 * @category   Interface
 * @package    CentraleLille:NewsFeedBundle
 * @subpackage ServicesInterfaces
 * @author     Lechaptois Martin <martin.lechaptois@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link       https://github.com/EBMCentraleLille/fablab
 */
interface FablabRecentProjectInterface
{
    /**
     * Retourne les projets récémments créés
     *
     * @param integer $limit nombre de projets retournés
     *
     * @return void
     */
    public function getRecentProjects($limit);
}
