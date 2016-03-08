<?php

namespace CentraleLille\CustomFosUserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use FOS\ElasticaBundle\Configuration\Search;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 * @Search(repositoryClass="CentraleLille\SearchBundle\Entity\SearchRepository\SearchRepository")
 * @ORM\HasLifecycleCallbacks
 */





class User extends BaseUser
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(name="firstname", type="string", length=255, nullable=true)
     */
    protected $firstname;

    /**
     * @var string
     * @ORM\Column(name="lastname", type="string", length=255, nullable=true)
     */
    protected $lastname;


    /**
     * @var string
     * @ORM\Column(name="promo", type="string", length=10, nullable=true)
     */
    protected $promo;

    /**
     * @var string
     * @ORM\Column(name="phone", type="string", length=25, nullable=true)
     */
    protected $phone;

    /**
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @return string
     */
    public function getPromo()
    {
        return $this->promo;
    }

    /**
     * @param string $promo
     */
    public function setPromo($promo)
    {
        $this->promo = $promo;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
}
