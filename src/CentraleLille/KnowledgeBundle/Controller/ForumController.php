<?php

namespace CentraleLille\KnowledgeBundle\Controller;

use CentraleLille\KnowledgeBundle\Entity\ForumThread;
use CentraleLille\KnowledgeBundle\Entity\ForumPost;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ForumController extends Controller
{
    /**
     * Get all threads
     * @return Response
     */
    public function indexAction()
    {
        $threads = $this->container->get('app.forum.service')->getRecentThreads(10);

        return $this->render(
            'CentraleLilleKnowledgeBundle::thread-list.html.twig',
            array('threads'=>$threads)
        );
    }

    /**
     * Get user's threads
     * @return Response
     */
    public function viewUserThreadsAction()
    {
        $user_id = $this->getUser()->getId();
        $userThreads = $this->container->get('app.forum.service')->getUserThreads($user_id);

        return $this->render(
            'CentraleLilleKnowledgeBundle::user-thread-list.html.twig',
            array('userThreads'=>$userThreads)
        );
    }

    /**
     * View thread
     * @return Redirect
     */
    public function viewThreadAction($id)
    {
        $thread = $this->container->get('app.forum.service')->getThread($id);
        $posts = $this->container->get('app.forum.service')->getPostList($id);

        return $this->render(
            'CentraleLilleKnowledgeBundle::post-list.html.twig',
            array('thread'=>$thread,'posts'=>$posts)
        );
    }

    /**
     * addThread
     *
     * Crée un formulaire permettant de créer un thread
     *
     * @param  Request $request récupère les données envoyées en POST
     *      *
     * @return Redirect
     */

    public function addThreadAction(Request $request)
    {
        $thread = new ForumThread();

        $formBuilder = $this->get('form.factory')->createBuilder('form', $thread);

        $formBuilder
            ->add('title', 'text')
            ->add('content', 'textarea')
    //        ->add('statut', ChoiceType::class, [
    //            'choices'=>array(
    //                'Ouvert'=>'Ouvert',
    //                'Resolu'=>'Resolu',
    //                'Inactif'=>'Inactif',
    //            ),
    //            'choices_as_values'=>true
    //        ])
            ->add('Ajouter', 'submit');

        $form = $formBuilder->getForm();
        $form->handleRequest($request);

        if ($form->isValid() && $thread != null) {
            $this ->addFlash('notice', 'Le sujet '.$thread->getTitle().' a bien été créé !');
            $thread->setAuthor($this->getUser());
            $thread->setStatus('Ouvert');
            $thread->setTags(['tag1','tag2']);
            $em = $this->getDoctrine()->getManager();
            $em->persist($thread);
            $em->flush();

            return $this->redirect(
                $this->generateUrl(
                    'knowledge_forum'
                )
            );
        }

        return $this->render(
            'CentraleLilleKnowledgeBundle::addThread.html.twig',
            array('form' => $form->createView())
        );
    }


    /**
     * delThread
     *
     * Permet de supprimer un Thread
     *
     * @param integer $id Id du thread à supprimer reçu dans l'URL
     *
     * @return Redirect
     */

    public function delThreadAction($id)
    {
            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('CentraleLilleKnowledgeBundle:ForumThread');
            $thread = $repository ->find($id);
            $em->remove($thread);
            $em->flush();
            $this ->addFlash('notice', 'Cette discussion a bien été supprimée.');
            return $this->redirect(
                $this->generateUrl(
                    'knowledge_forum'
                )
            );
    }

    /**
     * addPost
     *
     * Crée un formulaire permettant de créer un Post
     *
     * @param  Request $request récupère les données envoyées en POST
     *      *
     * @return Redirect
     */

    public function addPostAction($id, Request $request)
    {
            $forumpost = new ForumPost();

            $formBuilder = $this->get('form.factory')->createBuilder('form', $forumpost);

            $formBuilder
                ->add('content', 'textarea')
                ->add('Ajouter', 'submit');

            $form = $formBuilder->getForm();
            $form->handleRequest($request);

        if ($form->isValid() && $forumpost != null) {
            $this ->addFlash('notice', 'Votre réponse a bien été enregistrée.');
            $forumpost->setAuthor($this->getUser());
            $forumpost->setThread($this->container->get('app.forum.service')->getThread($id));
            $em = $this->getDoctrine()->getManager();
            $em->persist($forumpost);
            $em->flush();

            return $this->redirect(
                $this->generateUrl(
                    'knowledge_forum'
                )
            );
        }

            return $this->render(
                'CentraleLilleKnowledgeBundle::addPost.html.twig',
                array('form' => $form->createView())
            );
    }


    /**
     * delPost
     *
     * Permet de supprimer un Post
     *
     * @param integer $id Id du post à supprimer reçu dans l'URL
     *
     * @return Redirect
     */

    public function delPostAction($id)
    {
            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('CentraleLilleKnowledgeBundle:ForumPost');
            $forumpost = $repository ->find($id);
            $em->remove($forumpost);
            $em->flush();
            $this ->addFlash('notice', 'Cette réponse a bien été supprimée.');
            return $this->redirect(
                $this->generateUrl(
                    'knowledge_forum'
                )
            );
    }
}
