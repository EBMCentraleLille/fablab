<?php
/**
 * FablabActivitiesInterface.php Doc
 * 
 * Interface relatif aux activités
 *
 * PHP Version 5.6
 * 
 * @category   File
 * @package    CentraleLille:NewsFeedBundle
 * @subpackage ServicesInterfaces
 * @author     Corbière Charles <charles.corbiere@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link       https://github.com/EBMCentraleLille/fablab
 */

namespace CentraleLille\NewsFeedBundle\ServicesInterfaces;

/**
 * FablabActivitiesInterface Interface Doc
 *
 * Interface pour gérer les activités des projets
 * 
 * @category   Interface
 * @package    CentraleLille:NewsFeedBundle
 * @subpackage ServicesInterfaces
 * @author     Corbière Charles <charles.corbiere@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link       https://github.com/EBMCentraleLille/fablab
 */
interface FablabAbonnementsInterface
{
    /**
    * Créer l'activité généré par un user sur un projet
    *
    * @param object $user    Utilisateur
    * @param object $projet  Projet
    * @param object $type    Type d'activité
    * @param object $content Contenu à afficher de l'activité
    *
    * @return object L'entité générée
    */

    public function addActivite($user,$projet,$type,$content);
    
    /**
     * Fonction de recherche des activités liées à un projet
     * 
     * @param array   $projet Entité Projet
     * @param integer $nb     Nombre d'activités recherchées
     * @param integer $from   Offset de recherche
     *
     * @return array $activities Array d'Entités activités
     */
    public function getActivityProjet($projet,$nb,$from);
}

