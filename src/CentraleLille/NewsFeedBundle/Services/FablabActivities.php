<?php
/**
 * FablabActivities.php File Doc
 *
 * Service en charge de la création et la récupération des activités par projet
 *
 * PHP Version 5.5
 *
 * @category   File
 * @package    CentraleLille:NewsFeedBundle
 * @subpackage Services
 * @author     Corbière Charles <charles.corbiere@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link       https://github.com/EBMCentraleLille/fablab
 */

namespace CentraleLille\NewsFeedBundle\Services;

use CentraleLille\NewsFeedBundle\Entity\Activity;
use CentraleLille\NewsFeedBundle\ServicesInterfaces\FablabActivitiesInterface;

/**
 * FablabActivities Class Doc
 *
 * Services pour gérer les activités des projets
 * 
 * @category   Class
 * @package    CentraleLille:NewsFeedBundle
 * @subpackage Services
 * @author     Lechaptois Martin <martin.lechaptois@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link       https://github.com/EBMCentraleLille/fablab
 */
class FablabActivities implements FablabActivitiesInterface
{
    /**
     * Fonction construct de la classe FablabActivities
     * 
     * @param \Doctrine\ORM\EntityManager $entityManager Entity Manager de Doctrine
     *
     * @return void
     */
    public function __construct(\Doctrine\ORM\EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
    * Créer l'activité généré par un user sur un projet
    *
    * @param object $user    Utilisateur
    * @param object $projet  Projet
    * @param object $type    Type d'activité
    * @param object $content Contenu à afficher de l'activité
    *
    * @return void
    */
    public function creerActivite($user,$projet,$type,$content)
    {
        $date = new \DateTime();
        
        $activity=$this->em->getRepository("CentraleLilleNewsFeedBundle:Activity");
        $activity = new Activity;
        $activity->setDate($date);
        $activity->setUser($user);
        $activity->setProjet($projet);
        $activity->setType($type);
        $activity->setContent($content);

        $this->em->persist($activity);
        $this->em->flush();
        return $this;
    }

    /**
     * Fonction de recherche des activités liées à un projet
     * 
     * Retourne les $nb activités les plus récentes à partir de la $from
     * 
     * @param array   $projet Entité Projet
     * @param integer $nb     Nombre d'actualités recherchées
     * @param integer $from   Offset de recherche
     * 
     * @return array $activities Array d'Entités activités
     */
    public function getActivityProjet($projet,$nb,$from)
    {
        $repository=$this->em->getRepository("CentraleLilleNewsFeedBundle:Activity");
        $activities=$repository->findBy(
            array('projet'=>$projet),   // Critere
            array('date'=>'desc'),      // Tri par date décroissant
            $nb,                        // Selection de $nb activité seulement
            $from                       // A partir de la $from-ieme
        );
        
        return $activities;
    }
}