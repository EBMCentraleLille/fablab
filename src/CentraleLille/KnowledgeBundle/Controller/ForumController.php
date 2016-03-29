<?php

namespace CentraleLille\KnowledgeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * Get all threads
     * @return Response
     */
    public function indexAction()
    {
        $threads = $this->container->get('app.forum.service')->getThreadList();

        return $this->render(
            'KnowledgeBundle::thread-list.html.twig',
            array('threads'=>$threads)
        );
    }


    /**
     * View thread
     * @return Response
     */
    public viewThreadAction($id){
      $thread = $this->container->get('app.forum.service')->getThread($id);
      $posts = $this->container->get('app.forum.service')->getPostList($id);

      return $this->render(
          'KnowledgeBundle::thread-list.html.twig',
          array('thread'=>$thread,'posts'=>$posts)
      );
    }
}
