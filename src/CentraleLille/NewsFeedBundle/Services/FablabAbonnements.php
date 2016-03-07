<?php
/**
 * AbonnementRepository.php Doc
 * 
 * Services relatif aux abonnements permettant l'accès et la modification
 * aux données d'abonnements relatives à un user
 *
 * PHP Version 5.6
 *
 * @category   File
 * @package    CentraleLille:NewsFeedBundle
 * @subpackage Services
 * @author     Lechaptois Martin <martin.lechaptois@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link       https://github.com/EBMCentraleLille/fablab
 */

namespace CentraleLille\NewsFeedBundle\Services;

use CentraleLille\NewsFeedBundle\Entity\Abonnement;
use CentraleLille\DemoBundle\Entity\Projet;
use CentraleLille\NewsFeedBundle\ServicesInterfaces\FablabAbonnementsInterface;

/**
 * FablabAbonnements Class Doc
 *
 * Services pour gérer les abonnements utilisateurs
 * 
 * @category   Class
 * @package    CentraleLille:NewsFeedBundle
 * @subpackage Services
 * @author     Lechaptois Martin <martin.lechaptois@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link       https://github.com/EBMCentraleLille/fablab
 */
class FablabAbonnements implements FablabAbonnementsInterface
{
    /**
     * Fonction construct de la classe FablabAbonnements
     * 
     * @param \Doctrine\ORM\EntityManager $entityManager Entity Manager de Doctrine
     *
     * @return void
     */
    public function __construct(\Doctrine\ORM\EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }
    
    //
    /**
     * Fonction d'ajout de catégorie aux abonnements user
     * 
     * Ajoute une categorie aux abonnements catégories d'un utilisateur
     * 
     * @param array $user     Entité User
     * @param array $category Entité Category
     *
     * @return void
     */
    public function addAboCategory($user,$category)
    {
        $abonnement=$this->em->getRepository("CentraleLilleNewsFeedBundle:Abonnement");
        if (! $abonnement->findOneBy(array('user'=>$user))) {
            $abonnement = new Abonnement;
            $abonnement->setUser($user);
            $abonnement->setCategories($category);
        } else { 
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
     * Fonction d'ajout de projet aux abonnements user
     * 
     * Ajoute un projets aux abonnements projets d'un utilisateur
     * 
     * @param array $user   Entité User
     * @param array $projet Entité Projet
     *
     * @return void
     */
    public function addAboProjet($user,$projet)
    {
        $abonnement=$this->em->getRepository("CentraleLilleNewsFeedBundle:Abonnement");
        if (! $abonnement->findOneBy(array('user'=>$user))) {
            $abonnement = new Abonnement;
            $abonnement->setUser($user);
            $abonnement->setProjects($projet);
        } else { 
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
     * Fonction de recherche des abonnements catégories d'un user
     * 
     * Retourne les catégories auxquelles est abonné un user
     * sous forme de tableau.
     * 
     * @param array $user Entité User
     * 
     * @return array $categories
     */
    public function getAboCategory($user)
    {
        $repository=$this->em->getRepository("CentraleLilleNewsFeedBundle:Abonnement");
        $abonnement=$repository->findOneBy(
            array('user'=>$user)
        );
        return $abonnement->getCategories();
    }
    /**
     * Fonction de recherche des abonnements projets d'un user
     * 
     * Retourne un tableau des projets auxquels est abonné un user
     * sans les projets des catégories auxquelles il est abonné
     * 
     * @param array $user Entité User
     * 
     * @return array $projets
     */
    public function getAboProjet($user)
    {
        $repository=$this->em->getRepository("CentraleLilleNewsFeedBundle:Abonnement");
        $abonnement=$repository->findOneBy(
            array('user'=>$user)
        );
        return $abonnement->getProjects();
    }
    
    /**
     * Fonction de recherche de tous les abonnements d'un user
     * 
     * Retourne un tableau des projets auxquels est abonné un user
     * en comprenant également ceux des catégories auxquelles il est abonné
     * 
     * @param array $user Entité User
     * 
     * @return array $projets
     */
    public function getAboAll($user)
    {
        $projets=[];
        $abonnement=$this->em->getRepository("CentraleLilleNewsFeedBundle:Abonnement")->findOneBy(
            array('user'=>$user)
        );
        $aboCategories=$this->getAboCategory($user);
        $aboProjets=$this->getAboProjet($user);
        foreach ($aboProjets as $aboProjet) {
            array_push($projets, $aboProjet->getId());
        }
        foreach ($aboCategories as $aboCategory) {
            $projetsCat=$this->em->getRepository('CentraleLilleNewsFeedBundle:Category')->findOneBy(
                array('name'=>$aboCategory->getName())
            )->getProjets();
            foreach ($projetsCat as $projetCat) {
                if (! in_array($projetCat->getId(), $projets)) {
                    array_push($projets, $projetCat->getId());
                }
            }
        }
        return $projets;
    }
    
    /**
     * Fonction de suppression d'un abonnement catégorie d'un user
     * 
     * Supprime l'abonnement catégorie d'un user
     * 
     * @param array $user     Entité User
     * @param array $category Entité Category
     * 
     * @return void
     */
    public function removeAboCategory($user,$category)
    {
        $abonnement=$this->em->getRepository("CentraleLilleNewsFeedBundle:Abonnement")->findOneBy(
            array('user'=>$user)
        );      
        $abonnement->removeCategory($category);
        $this->em->persist($abonnement);
        $this->em->flush();
        return $this;
    }
    
    /**
     * Fonction de suppression d'un abonnement projet d'un user
     * 
     * Supprime l'abonnement projet d'un user
     * 
     * @param array $user   Entité User
     * @param array $projet Entité Projet
     * 
     * @return void
     */
    public function removeAboProjet($user,$projet)
    {
        $abonnement=$this->em->getRepository("CentraleLilleNewsFeedBundle:Abonnement")->findOneBy(
            array('user'=>$user)
        );
        $abonnement->removeProject($projet);
        $this->em->persist($abonnement);
        $this->em->flush();
        return $this;
    }
}