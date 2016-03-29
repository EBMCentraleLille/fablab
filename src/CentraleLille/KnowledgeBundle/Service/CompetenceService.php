<?php
namespace CentraleLille\KnowledgeBundle\Service;

use CentraleLille\KnowledgeBundle\Entity\Competence;
use CentraleLille\KnowledgeBundle\Entity\UserCompetence;

/**
 * Brought to you by Santa
 * User: JunkOS
 * Date: 25/12/2015
 * Time: 00:00
 */
class CompetenceService
{
    protected $em;
    public function __construct(\Doctrine\ORM\EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function createCompetence($name)
    {
        if ($name == null) {
            return false;
        } else {
            $competence = new Competence();
            $competence->setName($name);
            $this->em->persist($competence);
            $this->em->flush();
            return true;
        }
    }

    public function addCompetenceToUser($competence, $user, $level = 1)
    {
        if ($user == null || $competence == null) {
            return false;
        } else {
            $userCompetence = new UserCompetence();
            $userCompetence->setUser($user);
            $userCompetence->setCompetence($competence);
            $userCompetence->setLevel($level);
            $this->em->persist($userCompetence);
            $this->em->flush();
            return true;
        }
    }

    public function getCompetenceList()
    {
        return $this->em->getRepository('KnowledgeBundle:Competence')->find();
    }

    public function getUserCompetenceList($user)
    {
        $funk = function ($item) {
            return $item->getCompetence();

        };
        return array_map($funk, $this->em->getRepository('KnowledgeBundle:UserCompetence')->findByUser($user->getId()));
    }
}
