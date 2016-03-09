<?php
/**
 * Category.php File Doc
 *
 * Entité Category qui décrit les catégories de Projects
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
 * Category Class Doc
 *
 * Classe Category définissant l'entité Category
 * comprenant les attributs Id, Name et Projects
 *
 * @category   Class
 * @package    CentraleLille:NewsFeedBundle
 * @subpackage Entity
 * @author     Lechaptois Martin <martin.lechaptois@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link       https://github.com/EBMCentraleLille/fablab
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="CentraleLille\NewsFeedBundle\Repository\CategoryRepository")
 */
class Category
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
     * @var string
     *
     * @ORM\Column(name="Name", type="string", length=255)
     */
    private $name;

    /**
     * (targetEntity="CentraleLille\CustomFosUserBundle\Entity\Project"), cascade={"persist"})
     * @ORM\ManyToMany (targetEntity="CentraleLille\CustomFosUserBundle\Entity\Project"), cascade={"persist"})
     **/
    private $Projects;


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
     * Set name
     *
     * @param string $name Nom de la catégorie
     *
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set Projects
     *
     * @param string $Projects Objet Projects
     *
     * @return Category
     */
    public function setProjects($Projects)
    {
        $this->Projects = $Projects;

        return $this;
    }

    /**
     * Get Projects
     *
     * @return string
     */
    public function getProjects()
    {
        return $this->Projects;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->Projects = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add Project
     *
     * @param \CentraleLille\CustomFosUserBundle\Entity\Project $Project Objet Project
     *
     * @return Category
     */
    //public function addProject(\CentraleLille\CustomFosUserBundle\Entity\Project $Project)
    public function addProject(\CentraleLille\CustomFosUserBundle\Entity\Project $Project)
    {
        $this->Projects[] = $Project;

        return $this;
    }

    /**
     * Remove Project
     *
     * @param \CentraleLille\CustomFosUserBundle\Entity\Project $Project Objet Project
     *
     * @return void
     */
    //public function removeProject(\CentraleLille\CustomFosUserBundle\Entity\Project $Project)
    public function removeProject(\CentraleLille\CustomFosUserBundle\Entity\Project $Project)
    {
        $this->Projects->removeElement($Project);
    }
}
