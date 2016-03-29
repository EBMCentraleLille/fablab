<?php
/**
 * FablabStarProjectInterface.php Doc
 *
 * Interface relatif aux projets "star"
 *
 * PHP Version 5.6
 *
 * @category   File
 * @package    CentraleLille:HomepageBundle
 * @subpackage ServicesInterfaces
 * @author     Lechaptois Martin <martin.lechaptois@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link       https://github.com/EBMCentraleLille/fablab
 */
namespace CentraleLille\HomepageBundle\Services;

use Doctrine\Common\Persistence\ObjectManager;
use CentraleLille\NewsFeedBundle\Entity\Abonnement;
use CentraleLille\CustomFosUserBundle\Entity\Project;
use CentraleLille\HomepageBundle\ServicesInterfaces\FablabStarProjectInterface;

/**
 * FablabStarProjectInterface Interface Doc
 *
 * Interface pour gérer les projets "star"
 *
 * @category   Interface
 * @package    CentraleLille:HomepageBundle
 * @subpackage ServicesInterfaces
 * @author     Lechaptois Martin <martin.lechaptois@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link       https://github.com/EBMCentraleLille/fablab
 */
class FablabStarProject implements FablabStarProjectInterface
{
    /**
     * Fonction construct de la classe FablabStarProject
     *
     * @param ObjectManager $manager Entité Manager de Doctrine
     *
     * @return void
     */
    public function __construct(ObjectManager $manager)
    {
        $this->em = $manager;
    }

    /**
     * Ajoute un star project
     *
     * @param array  $project Entité Projet
     * @param string $content Text associé au star project
     *
     * @return void
     */
    public function addStarProject($project, $content)
    {
        $starProject = new StarProject;
        $starProject->setContent($content);
        $starProject->Projet($project);
        
        $this->em->persist($starProject);
        $this->em->flush();
        return $this;
    }

     /**
     * Modifie un star project
     *
     * @param integer $projectId ProjetId
     * @param string  $content   Text associé au star project
     *
     * @return void
     */
    public function modifyStarProject($projectId, $content)
    {
        $repository = $this->em->getRepository("CentraleLilleHomepageBundle:StarProject");
        $starProject= $repository->find($projectId);
        $starProject->setContent($content);

        $this->em->persist($starProject);
        $this->em->flush();
        return $this;
    }
    
    /**
     * Retourne tous les star projects
     *
     * @return array $starProjects Array d'entités StarProject
     */
    public function getAllStarProjects()
    {
        $starProject=[];
        $starProjects=[];
        $repository = $this->em->getRepository("CentraleLilleHomepageBundle:StarProject");
        $rawStarProjects = $repository->findAll();
        foreach ($rawStarProjects as $rawStarProject) {
            $starProject["content"] = $rawStarProject -> getContent();
            $starProject["projectName"] = $rawStarProject -> getProject()->getName();
            $starProject["projectPicture"] = $rawStarProject -> getProject()->getPicture();
            $starProject["projectId"] = $rawStarProject -> getProject()->getId();
            array_push($starProjects, $starProject);
        }
        return $starProjects;
    }

    /**
     * Retourne un ou plusieurs star projects
     *
     * @param integer $limit Nombre de star projets retournés
     *
     * @return array $starProjects Array d'entités StarProject
     */
    public function getStarProjects($limit = 1)
    {
        $starProjects = [];
        $starProject = [];
        $repository = $this->em->getRepository("CentraleLilleHomepageBundle:StarProject");
        $query = $repository->createQueryBuilder('p')
            ->orderBy('p.id', 'DESC')
            ->setMaxResults($limit)
            ->getQuery();
        if ($limit = 1) {
            $rawStarProjects = $query->getSingleResult();
            $starProject["content"] = $rawStarProjects -> getContent();
            $starProject["projectName"] = $rawStarProjects -> getProject()->getName();
            $starProject["projectPicture"] = $rawStarProjects -> getProject()->getPicture();
            $starProject["projectId"] = $rawStarProjects -> getProject()->getId();
            $starProjects=$starProject;
        } else {
            $rawStarProjects = $query->getResult();
            foreach ($rawStarProjects as $rawStarProject) {
                $starProject["content"] = $rawStarProjects -> getContent();
                $starProject["projectName"] = $rawStarProject -> getProject()->getName();
                $starProject["projectPicture"] = $rawStarProject -> getProject()->getPicture();
                $starProject["projectId"] = $rawStarProject -> getProject()->getId();
                array_push($starProjects, $starProject);
            }
        }
        return $starProjects;
    }

    /**
     * Supprime un star project
     *
     * @param integer $starProjectId id StarProject
     *
     * @return void
     */
    public function removeStarProject($starProjectId)
    {
        $repository = $this->em->getRepository("CentraleLilleHomepageBundle:StarProject");
        $starProject = $repository->find($starProjectId);
        $this->em->remove($starProject);
        $this->em->flush();
    }
}
