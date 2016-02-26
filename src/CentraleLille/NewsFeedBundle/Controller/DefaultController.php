<?php

namespace CentraleLille\NewsFeedBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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

            $abonnementService = $this->container->get('fablab_newsfeed.abonnements');
            $projets=$abonnementService->aboProjet('Martin');

        return $this->render('NewsFeedBundle:newsFeed.html.twig',[
        	'recentProjects' => $recentProjects,
            'suggestions' => $suggestions
        ]);
    }
}
