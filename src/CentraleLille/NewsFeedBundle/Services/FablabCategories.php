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
namespace CentraleLille\NewsFeedBundle\Services;

use Doctrine\Common\Persistence\ObjectManager;
use CentraleLille\NewsFeedBundle\Entity\Category;
use CentraleLille\NewsFeedBundle\ServicesInterfaces\FablabCategoriesInterface;

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
class FablabCategories implements FablabCategoriesInterface
{
    /**
     * Fonction construct de la classe FablabCategories
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
     * Crée une catégorie
     *
     * @param array $categoryName nom de la catégorie
     *
     * @return void
     */
    public function addCategory($categoryName)
    {
        $category = new Category;
        $category->setName($categoryName);
        $this->em->persist($category);
        $this->em->flush();
    }
    /**
     * Crée une catégorie
     *
     * @param array $categoryName Nom de la catégorie
     * @param array $project      Entité Projet à ajouter à la catégorie
     *
     * @return void
     */
    public function addProjectCategory($categoryName, $project)
    {
        $repository=$this->em->getRepository("CentraleLilleNewsFeedBundle:Category");
        $category=$repository->findOneBy(
            array('name'=>$categoryName)
        );
        $category->addProject($project);
        $this->em->persist($category);
        $this->em->flush();

        return $this;
    }
    /**
     * Recherche tous les noms des catégories et ne renvoie que les $nb premières
     *
     * @param integer $nb     nombre de categories recherchées
     * @param integer $offset offset de recherche
     *
     * @return array $categories Tableau de catégories
     */
    public function getCategories($nb = 0, $offset = 0)
    {
        $categories=[];
        $repository=$this->em->getRepository("CentraleLilleNewsFeedBundle:Category");
        $categoriesEntities=$repository->findAll();

        if ($nb != 0) {
            foreach ($categoriesEntities as $categoryEntity) {
                array_push($categories, $categoryEntity);
                $categories=array_slice($categories, $offset, $nb);
            }
        } else {
            $categories=$categoriesEntities;
        }
        
        return $categories;
    }

    /**
     * Retourne un tableau des projets d'une catégorie
     *
     * @param string $categoryName Nom de la catégorie
     *
     * @return array $projectsCategory Tableau des projets relatifs à la catgégorie
     */
    public function getProjectsCategory($categoryName)
    {
        $repository=$this->em->getRepository("CentraleLilleNewsFeedBundle:Category");
        $category=$repository->findOneBy(
            array('name'=>$categoryName)
        );
        $projectsCategory=$category->getProjects();
        return $projectsCategory;
    }

    /**
     * Retourne un tableau des users abonnés à une catégorie
     *
     * @param string $categoryName Nom de la catégorie
     *
     * @return array $usersCategory Tableau des users abonnés à la catgégorie
     */
    public function getUsersCategory($categoryName)
    {
        $repository=$this->em->getRepository("CentraleLilleNewsFeedBundle:Category");
        $category=$repository->findOneBy(
            array('name'=>$categoryName)
        );
        $usersCategory=$category->getUsers();
        return $usersCategory;
    }

    /**
     * Supprime une catégorie
     *
     * @param string $categoryName Nom de la catégorie à supprimer
     *
     * @return void
     */
    public function removeCategory($categoryName)
    {
        $repository=$this->em->getRepository("CentraleLilleNewsFeedBundle:Category");
        $category=$repository->findOneBy(
            array('name'=>$categoryName)
        );
        $this->em->remove($category);
        $this->em->flush();
        return $this;
    }

    /**
     * Supprime un projet d'une catégorie
     *
     * @param string $categoryName Nom de la catégorie
     * @param array  $projet       Entité Projet à supprimer de la catégorie
     *
     * @return void
     */
    public function removeProjectCategory($categoryName, $projet)
    {
        $repository=$this->em->getRepository("CentraleLilleNewsFeedBundle:Category");
        $category=$repository->findOneBy(
            array('name'=>$categoryName)
        );
        $category->removeProject($projet);
        $this->em->persist($category);
        $this->em->flush();
        return $this;
    }
}
