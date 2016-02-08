<?php

namespace CentraleLille\CustomFosUserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
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
     * @ORM\Column(name="firstname", type="string", length=255)
     */
    protected $firstname;

    /**
     * @var string
     * @ORM\Column(name="lastname", type="string", length=255)
     */
    protected $lastname;

    /**
     * @var string
     * @ORM\Column(name="birthdate", type="string", length=255)
     */
    protected $birthdate;

    /**
     * @var string
     * @ORM\Column(name="sex", type="string", length=10, nullable=true)
     */
    protected $sex;

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

}