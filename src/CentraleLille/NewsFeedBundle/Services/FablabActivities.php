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

use Doctrine\Common\Persistence\ObjectManager;
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
     * @param ObjectManager $manager Entity Manager de Doctrine
     *
     * @return void
     */
    public function __construct(ObjectManager $manager)
    {
        $this->em = $manager;
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
    public function addActivity($user, $projet, $type, $content = "")
    {
        $date = new \DateTime();
        
        $activity = new Activity;
        $activity->setDate($date);
        $activity->setUser($user);
        $activity->setProject($projet);
        $activity->setType($type);
        if ($type = 1) {
            $content = "Martin a créé le projet.";
        } elseif ($type = 2) {
            $content = "Martin a mis à jour le projet.";
        }

        $activity->setContent($content);

        $this->em->persist($activity);
        $this->em->flush();
        return $this;
    }

    /**
     * Fonction de recherche des activités liées à un projet
     *
     * Retourne les $nb activités du projet $projet les plus récentes à partir de la $from
     *
     * @param array   $projet Entité Projet
     * @param integer $nb     Nombre d'actualités retournées souhaitées
     * @param integer $offset Offset de recherche
     *
     * @return array $activities Array d'Entités activités
     */
    public function getActivityProjet($projet, $nb, $offset = 0)
    {
        $repository=$this->em->getRepository("CentraleLilleNewsFeedBundle:Activity");
        $activities=$repository->findBy(
            array('projet'=>$projet),     // Recherche par projets
            array('date'=>'desc'),        // Tri par date décroissante
            $nb,                          // Selection de $nb activités seulement
            $offset                       // A partir de l'offset
        );
        
        return $activities;
    }

    /**
     * Fonction de recherche des activités liées à un projet
     *
     * Retourne les $nb activités les plus récentes à partir de la $from
     *
     * @param integer $limit  Nombre d'actualités recherchées
     * @param integer $offset Offset de recherche
     *
     * @return array $activities Array d'Entités activités
     */
    public function getActivities($limit, $offset = 0)
    {
        $repository=$this->em->getRepository("CentraleLilleNewsFeedBundle:Activity");
        $query = $repository->createQueryBuilder('a')
            ->orderBy('a.date', 'DESC')
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->getQuery();
        $activities = $query->getResult();
        
        return $activities;
    }
}
