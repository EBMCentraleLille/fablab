<?php
/**
 * Category.php File Doc
 *
 * Entité Category qui décrit les catégories de projets
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
    * @ORM\ManyToMany (targetEntity="CentraleLille\DemoBundle\Entity\Projet"), cascade={"persist"})
    **/
    private $projets;


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
     * Set projets
     *
     * @param string $projets Objet Projets
     *
     * @return Category
     */
    public function setProjets($projets)
    {
        $this->projets = $projets;

        return $this;
    }

    /**
     * Get projets
     *
     * @return string
     */
    public function getProjets()
    {
        return $this->projets;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->projets = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add projet
     *
     * @param \CentraleLille\DemoBundle\Entity\Projet $projet Objet Projet
     *
     * @return Category
     */
    public function addProjet(\CentraleLille\DemoBundle\Entity\Projet $projet)
    {
        $this->projets[] = $projet;

        return $this;
    }

    /**
     * Remove projet
     *
     * @param \CentraleLille\DemoBundle\Entity\Projet $projet Objet Projet
     *
     * @return void
     */
    public function removeProjet(\CentraleLille\DemoBundle\Entity\Projet $projet)
    {
        $this->projets->removeElement($projet);
    }
}
