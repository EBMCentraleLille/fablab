<?php

namespace CentraleLille\NewsFeedBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use NewsFeedBundle\Entity\Abonnement;
use DemoBundle\Entity\User;
use DemoBundle\Entity\Projet;

class DefaultController extends Controller
{
    public function indexAction()
    {
    	$recentProjects=[
    		[
    			'userName'=>'Martin Lechaptois',
    			'projectName'=>'Project De Martin',
    			'projectPic'=>'http://thingiverse-production-new.s3.amazonaws.com/renders/71/73/1f/f0/10/1c60646068ae96e9d944ead31ad3c6ec_preview_featured.jpg',
    			'likes'=>19,
    			'messages'=>3,
    			'files'=>4,
                'date'=>"25/10/2011"
    		],
            [
                'userName'=>'Martin Lechaptois',
                'projectName'=>'Project De Martin',
                'projectPic'=>'http://thingiverse-production-new.s3.amazonaws.com/renders/71/73/1f/f0/10/1c60646068ae96e9d944ead31ad3c6ec_preview_featured.jpg',
                'likes'=>19,
                'messages'=>3,
                'files'=>4,
                'date'=>"25/10/2011"
            ],
            [
                'userName'=>'Martin Lechaptois',
                'projectName'=>'Project De Martin',
                'projectPic'=>'http://thingiverse-production-new.s3.amazonaws.com/renders/71/73/1f/f0/10/1c60646068ae96e9d944ead31ad3c6ec_preview_featured.jpg',
                'likes'=>19,
                'messages'=>3,
                'files'=>4,
                'date'=>"25/10/2011"
            ]];
        $suggestions=[
            [
                'type'=>1,
                'name'=>'Project De Martin'
            ],
            [
                'type'=>2,
                'name'=>'Catégorie Charles'
            ],
            [
                'type'=>1,
                'name'=>'Project De James'
            ],
            [
                'type'=>2,
                'name'=>'Catégorie Roger'
            ],
            [
                'type'=>1,
                'name'=>'Project De Martin'
            ]
            ];             
            $em=$this->getDoctrine()->getManager();
            $user=$em->getRepository('CentraleLilleDemoBundle:User')->findOneBy(array('name'=>'Martin'));
            $projet=$em->getRepository('CentraleLilleDemoBundle:Projet')->findOneBy(array('name'=>'projet2'));
            $category=$em->getRepository('CentraleLilleNewsFeedBundle:Category')->findOneBy(array('name'=>'category1'));

            $abonnementService = $this->container->get('fablab_newsfeed.abonnements');
            //$abonnementService->addAboProjet($user,$projet);
            //$abonnementService->addAboCategory($user,$category);
            //$projets=$abonnementService->getAboProjet($user); 
            //$categories=$abonnementService->getAboCategory($user); 
            $projets=$abonnementService->getAboAll($user); 
            //$abonnementService->removeAboProjet($user,$projet);
            //$abonnementService->removeAboCategory($user,$category);
            var_dump($projets);die;

        return $this->render('CentraleLilleNewsFeedBundle:newsFeed.html.twig',[
            'recentProjects' => $recentProjects,
            'suggestions' => $suggestions
        ]);
    }
}
