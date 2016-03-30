<?php
/**
 * Abonnements.php File Doc
 *
 * Entité Abonnement qui décrit les abonnements
 * aux Projects ainsi qu'aux catégories des utilisateurs
 *
 * PHP Version 5.6
 *
 * @category   File
 * @package    CentraleLille:NewsFeedBundle
 * @subpackage Entity
 * @author     Lechaptois Martin <martin.lechaptois@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link       https://github.com/EBMCentraleLille/fablab
 */
namespace CentraleLille\NewsFeedBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Abonnement Class Doc
 *
 * Classe Abonnement définissant l'entité Abonnement
 * comprenant les attributs Id, User, Categories et Projects
 *
 * @category   Class
 * @package    CentraleLille:NewsFeedBundle
 * @subpackage Entity
 * @author     Lechaptois Martin <martin.lechaptois@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link       https://github.com/EBMCentraleLille/fablab
 *
 * @ORM\Table(name="abonnement")
 * @ORM\Entity(repositoryClass="CentraleLille\NewsFeedBundle\Repository\AbonnementRepository")
 */
class Abonnement
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
    * @ORM\ManyToOne (targetEntity="CentraleLille\CustomFosUserBundle\Entity\User"), cascade={"persist"})
    * @ORM\JoinColumn(nullable=false)
    **/
    private $user;

    /**
    * @ORM\ManyToMany (targetEntity="CentraleLille\NewsFeedBundle\Entity\Category"), cascade={"persist"})
    **/
    private $categories;

    /**
     *
     * @ORM\ManyToMany (targetEntity="CentraleLille\CustomFosUserBundle\Entity\Project"), cascade={"persist"})
     */
    private $projects;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set user
     *
     * @param string $user Objet user
     *
     * @return Abonnement
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set categories
     *
     * @param string $categories Objet category
     *
     * @return Abonnement
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * Get categories
     *
     * @return string
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Set projects
     *
     * @param string $projects Objet Projects
     *
     * @return Abonnement
     */
    public function setProjects($projects)
    {
        $this->projects = $projects;

        return $this;
    }

    /**
     * Get projects
     *
     * @return string
     */
    public function getProjects()
    {
        return $this->projects;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
        $this->projects = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add category
     *
     * @param \CentraleLille\NewsFeedBundle\Entity\Category $category Objet Category
     *
     * @return Abonnement
     */
    public function addCategory(\CentraleLille\NewsFeedBundle\Entity\Category $category)
    {
        $this->categories[] = $category;
        $category->addUser($this->getUser());

        return $this;
    }

    /**
     * Remove category
     *
     * @param \CentraleLille\NewsFeedBundle\Entity\Category $category Objet Category
     *
     * @return void
     */
    public function removeCategory(\CentraleLille\NewsFeedBundle\Entity\Category $category)
    {
        $this->categories->removeElement($category);
        $category->removeUser($this->getUser());
    }

    /**
     * Add project
     *
     * @param \CentraleLille\CustomFosUserBundle\Entity\Project $project Objet Project
     *
     * @return Abonnement
     */
    public function addProject(\CentraleLille\CustomFosUserBundle\Entity\Project $project)
    {
        $this->projects[] = $project;

        return $this;
    }

    /**
     * Remove project
     *
     * @param \CentraleLille\CustomFosUserBundle\Entity\Project $project Objet Project
     *
     * @return void
     */
    public function removeProject(\CentraleLille\CustomFosUserBundle\Entity\Project $project)
    {
        $this->projects->removeElement($project);
    }

    /**
     * Add user
     *
     * @param \CentraleLille\CustomFosUserBundle\Entity\User $user Objet User
     *
     * @return Abonnement
     */
    public function addUser(\CentraleLille\CustomFosUserBundle\Entity\User $user)
    {
        $this->user[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \CentraleLille\CustomFosUserBundle\Entity\User $user Objet User
     *
     * @return void
     */
    public function removeUser(\CentraleLille\CustomFosUserBundle\Entity\User $user)
    {
        $this->user->removeElement($user);
    }
}
