<?php
namespace CentraleLille\KnowledgeBundle\Service;

use CentraleLille\KnowledgeBundle\Entity\ForumThread;
use CentraleLille\KnowledgeBundle\Entity\ForumPost;

/**
 * Author : Achille Urbain
 * Date: 29/03/15
 * Time: 08:44
 */
class ForumService
{
    protected $em;
    public function __construct(\Doctrine\ORM\EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function getThread($id)
    {
        return $this->em->getRepository('CentraleLilleKnowledgeBundle:ForumThread')->findOneById($id);
    }

    public function getThreadList()
    {
        return $this->em->getRepository('CentraleLilleKnowledgeBundle:ForumThread')->findAll();
    }

    /**
     * Retourne les threads récemment créés
     *
     * @param integer $limit nombre de threads retournés
     *
     * @return array $recentThreads
     */
    public function getRecentThreads($limit)
    {
        $repository = $this->em->getRepository("CentraleLilleKnowledgeBundle:ForumThread");
        $query = $repository->createQueryBuilder('a')
            ->orderBy('a.id', 'DESC')
            ->setMaxResults($limit)
            ->getQuery();
        $recentProjects = $query->getResult();

        return $recentProjects;
    }

    public function getUserThreads($user_id)
    {
        if ($user_id == null) {
            return false;
        } else {
            return $this->em->getRepository('CentraleLilleKnowledgeBundle:ForumThread')->findByAuthor($user_id);
        }

        return $userProjects;
    }

    public function getPostList($thread_id)
    {
        if ($thread_id == null) {
            return false;
        } else {
            return $this->em->getRepository('CentraleLilleKnowledgeBundle:ForumPost')->findByThread($thread_id);
        }
    }

    public function createThread($author, $title, $content, $tags, $status = 'Ouvert')
    {
        if ($author == null || $title == null || $content = null || $tags == null) {
            return false;
        } else {
            $thread = new ForumThread();
            $thread->setAuthor($author);
            $thread->setTitle($title);
            $thread->setContent($content);
            $thread->setStatus($status);
            $thread->setTags($tags);

            $this->em->persist($thread);
            $this->em->flush();
            return true;
        }
    }

    public function addPostToThread($thread, $author, $content)
    {
        if ($thread == null || $thread == null || $content == null) {
            return null;
        } else {
            $post = new ForumPost();
            $post->setAuthor($author);
            $post->setThread($thread);
            $post->setContent($content);

            $this->em->persist($post);
            $this->em->flush();
            return true;
        }
    }
}
