<?php

namespace CentraleLille\KnowledgeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ForumPost
 *
 * @ORM\Table(name="forum_post")
 * @ORM\Entity(repositoryClass="CentraleLille\KnowledgeBundle\Repository\ForumPostRepository")
 */
class ForumPost
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
    * @ORM\ManyToOne(targetEntity="\CentraleLille\CustomFosUserBundle\Entity\User")
    * @ORM\JoinColumn(name="author_id", referencedColumnName="id")
     */
    private $author;

    /**
    * @ORM\ManyToOne(targetEntity="\CentraleLille\KnowledgeBundle\Entity\ForumThread")
    * @ORM\JoinColumn(name="thread_id", referencedColumnName="id")
     */
    private $thread;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
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
     * Set content
     *
     * @param string $content
     *
     * @return ForumPost
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

    /**
     * Get author
     *
     * @return User
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set author
     *
     * @return ForumPost
     */
    public function setAuthor($author)
    {
        $this->author = $author;
        return $this;
    }

    /**
     * Get thread
     *
     * @return ForumThread
     */
    public function getThread()
    {
        return $this->thread;
    }

    /**
     * Set thread
     *
     * @return ForumPost
     */
    public function setThread($thread)
    {
        $this->thread = $thread;
        return $this;
    }
}
