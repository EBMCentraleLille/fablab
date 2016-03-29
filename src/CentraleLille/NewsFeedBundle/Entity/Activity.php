<?php
/**
 * Activity.php File Doc
 *
 * Entité représentant une activité
 * Une activité peut etre de trois type :
 *      1 - une création
 *      2 - une modification
 *      3 - une publication
 *
 * PHP Version 5.5
 *
 * @category Activity
 * @package  NewsFeedBundle
 * @author   Corbière Charles <charles.corbiere@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/EBMCentraleLille/fablab
 */

namespace CentraleLille\NewsFeedBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Activity Class Doc
 *
 * Classe Activity définissant l'entité Activity
 * comprenant les attributs Id, Date, Project, User,
 * Type et Content
 *
 * @category   Class
 * @package    CentraleLille:NewsFeedBundle
 * @subpackage Entity
 * @author     Lechaptois Martin <martin.lechaptois@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link       https://github.com/EBMCentraleLille/fablab
 *
 * @ORM\Table(name="activity")
 * @ORM\Entity(repositoryClass="CentraleLille\NewsFeedBundle\Repository\ActivityRepository")
 */
class Activity
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
     * @var \DateTime
     *
     * @ORM\Column(name="Date", type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne (targetEntity="CentraleLille\CustomFosUserBundle\Entity\Project"), cascade={"persist"})
     */
    private $project;

    /**
    * @ORM\ManyToOne (targetEntity="CentraleLille\CustomFosUserBundle\Entity\User"), cascade={"persist"})
    **/
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="Name", type="string", length=255)
     */
    private $type;

    /**
     * @var text
     *
     * @ORM\Column(name="Content", type="text", nullable=true)
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
     * Set date
     *
     * @param \DateTime $date Date de création de l'actualité
     *
     * @return Activity
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set project
     *
     * @param string $project Objet Project
     *
     * @return Activity
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
     * Set user
     *
     * @param string $user Objet User
     *
     * @return Activity
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
     * Set type
     *
     * @param string $type Type de l'actualité: Création/Update/Personnalisé
     *
     * @return Activity
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set attribute
     *
     * @param string $content Contenu de l'actualité
     *
     * @return Activity
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get attribute
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->project = new \Doctrine\Common\Collections\ArrayCollection();
        $this->user = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add project
     *
     * @param \CentraleLille\CustomFosUserBundle\Entity\Project $project Objet Project
     *
     * @return Activity
     */
    //public function addProject(\CentraleLille\CustomFosUserBundle\Entity\Project $project)
    public function addProject(\CentraleLille\CustomFosUserBundle\Entity\Project $project)
    {
        $this->project[] = $project;

        return $this;
    }

    /**
     * Remove project
     *
     * @param \CentraleLille\CustomFosUserBundle\Entity\Project $project Objet Project
     *
     * @return void
     */
    //public function removeProject(\CentraleLille\CustomFosUserBundle\Entity\Project $project)
    public function removeProject(\CentraleLille\CustomFosUserBundle\Entity\Project $project)
    {
        $this->project->removeElement($project);
    }

    /**
     * Add user
     *
     * @param \CentraleLille\CustomFosUserBundle\Entity\User $user Objet User
     *
     * @return Activity
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
