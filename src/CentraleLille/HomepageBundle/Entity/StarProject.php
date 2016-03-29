<?php
/**
 * StarProject.php File Doc
 *
 * Entité Star Project
 *
 * PHP Version 5.6
 *
 * @category   File
 * @package    CentraleLille:HomepageBundle
 * @subpackage Entité
 * @author     Lechaptois Martin <martin.lechaptois@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link       https://github.com/EBMCentraleLille/fablab
 */

namespace CentraleLille\HomepageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StarProject Class Doc
 *
 * Classe StarProjectt définissant l'entité StarProject
 * comprenant les attributs Id, Project et Content
 *
 * @category   Class
 * @package    CentraleLille:HomepageBundle
 * @subpackage Entity
 * @author     Lechaptois Martin <martin.lechaptois@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link       https://github.com/EBMCentraleLille/fablab
 *
 * @ORM\Table(name="star_project")
 * @ORM\Entity(repositoryClass="CentraleLille\HomepageBundle\Repository\StarProjectRepository")
 */
class StarProject
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
     * @ORM\ManyToOne (targetEntity="CentraleLille\CustomFosUserBundle\Entity\Project"), cascade={"persist"})
     */
    private $project;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="string", length=255)
     */
    private $content;

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
     * Set project
     *
     * @param string $project Entité projet
     *
     * @return StarProject
     */
    public function setProject($project)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return string
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Set content
     *
     * @param string $content Contenu à afficher
     *
     * @return StarProject
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }
}
