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
        if ($type = 'creation') {
            $content = "Martin a créé le projet.";
        } elseif ($type = 'update') {
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
            array('project'=>$projet),     // Recherche par projets
            array('date'=>'desc'),        // Tri par date décroissante
            $nb,                          // Selection de $nb activités seulement
            $offset                       // A partir de l'offset
        );
        
        return $activities;
    }

    /**
     * Fonction de recherche de toutes les activités
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

    /**
     * Fonction de recherche des activités en fonction des abonnements d'un user
     *
     * @param array   $abonnements Entité Projet
     * @param integer $nb          Nombre d'activités recherchées
     * @param integer $offset      Offset de recherche
     *
     * @return array $activities Array d'Entités activités
     */
    public function getActivitiesNewsFeed($abonnements, $nb, $offset = 0)
    {
        $activities = [];
        $repository=$this->em->getRepository("CentraleLilleNewsFeedBundle:Activity");

        foreach ($abonnements as $abonnement) {
            $query = $repository->createQueryBuilder('a')
                ->where('a.project = :abonnement')
                ->orderBy('a.date', 'DESC')
                ->setParameter('abonnement', $abonnement)
                ->setFirstResult($offset)
                ->setMaxResults($nb)
                ->getQuery();
            $activitiesProjet = $query->getResult();
            array_push($activities, $activitiesProjet);
        }

        $activities = call_user_func_array('array_merge', $activities);
        usort(
            $activities,
            function ($a, $b) {
                if ($a > $b) {
                    return -1;
                } elseif ($a < $b) {
                    return 1;
                } else {
                    return 0;
                }
            }
        );

        return array_splice($activities, 0, $nb);

    }
}
