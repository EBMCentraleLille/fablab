<?php

namespace CentraleLille\SearchBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\ElasticaBundle\Configuration\Search;

/**
* Demo
*
* @ORM\Table(name="demo")
* @Search(repositoryClass="CentraleLille\SearchBundle\Repository\DemoRepository")
* @ORM\Entity(repositoryClass="CentraleLille\SearchBundle\Repository\DemoRepository")
* @ORM\HasLifecycleCallbacks
*/
class Demo
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
  * @ORM\Column(name="title", type="string", length=255)
  */
  private $title;

  /**
  * @var string
  *
  * @ORM\Column(name="content", type="text")
  */
  private $content;

  /**
  * @var \DateTime
  *
  * @ORM\Column(name="createdAt", type="datetime")
  */
  private $createdAt;

  /**
  * @ORM\PrePersist
  */
  public function prePersist()
  {
    $this->createdAt = new \DateTime();
  }



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
  * Set title
  *
  * @param string $title
  *
  * @return Demo
  */
  public function setTitle($title)
  {
    $this->title = $title;

    return $this;
  }

  /**
  * Get title
  *
  * @return string
  */
  public function getTitle()
  {
    return $this->title;
  }

  /**
  * Set content
  *
  * @param string $content
  *
  * @return Demo
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
  * Set createdAt
  *
  * @param \DateTime $createdAt
  *
  * @return Demo
  */
  public function setCreatedAt($createdAt)
  {
    $this->createdAt = $createdAt;

    return $this;
  }

  /**
  * Get createdAt
  *
  * @return \DateTime
  */
  public function getCreatedAt()
  {
    return $this->createdAt;
  }
}
