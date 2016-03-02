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
 * Activity
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
    * @ORM\ManyToMany (targetEntity="CentraleLille\DemoBundle\Entity\Projet"), cascade={"persist"})
    **/
    private $project;

    /**
    * @ORM\ManyToMany (targetEntity="CentraleLille\DemoBundle\Entity\User"), cascade={"persist"})
    **/
    private $user;

    /**
     * @var int
     *
     * @ORM\Column(name="Type", type="integer")
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
     * @param \DateTime $date
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
     * @param string $project
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
     * @param string $user
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
     * @param integer $type
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
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set attribute
     *
     * @param string $attribute
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
     * @param \CentraleLille\DemoBundle\Entity\Projet $project
     *
     * @return Activity
     */
    public function addProject(\CentraleLille\DemoBundle\Entity\Projet $project)
    {
        $this->project[] = $project;

        return $this;
    }

    /**
     * Remove project
     *
     * @param \CentraleLille\DemoBundle\Entity\Projet $project
     */
    public function removeProject(\CentraleLille\DemoBundle\Entity\Projet $project)
    {
        $this->project->removeElement($project);
    }

    /**
     * Add user
     *
     * @param \CentraleLille\DemoBundle\Entity\User $user
     *
     * @return Activity
     */
    public function addUser(\CentraleLille\DemoBundle\Entity\User $user)
    {
        $this->user[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \CentraleLille\DemoBundle\Entity\User $user
     */
    public function removeUser(\CentraleLille\DemoBundle\Entity\User $user)
    {
        $this->user->removeElement($user);
    }
}
