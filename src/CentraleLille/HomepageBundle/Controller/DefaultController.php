<?php

namespace CentraleLille\HomepageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
    	$weeklyProject=[
            'projectId'=>'3',
    		'projectName'=>'Projet De La semaine',
    		'projectDescription'=>'Ceci est la description du projet de la semaine',
    		'projectPicture'=>'http://thingiverse-production-new.s3.amazonaws.com/renders/71/73/1f/f0/10/1c60646068ae96e9d944ead31ad3c6ec_preview_featured.jpg'
    	];
    	$news=[
    		[
    			'userName'=>'Martin Lechaptois',
    			'projectName'=>'Project De Martin',
    			'projectPic'=>'http://thingiverse-production-new.s3.amazonaws.com/renders/71/73/1f/f0/10/1c60646068ae96e9d944ead31ad3c6ec_preview_featured.jpg',
    			'newsType'=>'a commenté'
    		],
    		[
    			'userName'=>'Martin Lechaptois',
    			'projectName'=>'Project De Martin',
    			'projectPic'=>'http://thingiverse-production-new.s3.amazonaws.com/renders/71/73/1f/f0/10/1c60646068ae96e9d944ead31ad3c6ec_preview_featured.jpg',
    			'newsType'=>'a commenté'
    		],
    		[
    			'userName'=>'Martin Lechaptois',
    			'projectName'=>'Project De Martin',
    			'projectPic'=>'http://thingiverse-production-new.s3.amazonaws.com/renders/71/73/1f/f0/10/1c60646068ae96e9d944ead31ad3c6ec_preview_featured.jpg',
    			'newsType'=>'a commenté'
    		],
    		[
    			'userName'=>'Martin Lechaptois',
    			'projectName'=>'Project De Martin',
    			'projectPic'=>'http://thingiverse-production-new.s3.amazonaws.com/renders/71/73/1f/f0/10/1c60646068ae96e9d944ead31ad3c6ec_preview_featured.jpg',
    			'newsType'=>'a commenté'
    		],
    		[
    			'userName'=>'Martin Lechaptois',
    			'projectName'=>'Project De Martin',
    			'projectPic'=>'http://thingiverse-production-new.s3.amazonaws.com/renders/71/73/1f/f0/10/1c60646068ae96e9d944ead31ad3c6ec_preview_featured.jpg',
    			'newsType'=>'a commenté'
    		]];
    	$thematics=['Mécanique','Impression 3D','Arduino','Électronique','Drone','CAO','Informatique','Réalité Virtuelle'];
    	$recentProjects=[
    		[
    			'userName'=>'Martin Lechaptois',
    			'projectName'=>'Project De Martin',
    			'projectPic'=>'http://thingiverse-production-new.s3.amazonaws.com/renders/71/73/1f/f0/10/1c60646068ae96e9d944ead31ad3c6ec_preview_featured.jpg',
    			'likes'=>19,
    			'messages'=>3,
    			'files'=>4
    		],
    		[
    			'userName'=>'Martin Lechaptois',
    			'projectName'=>'Project De Martin',
    			'projectPic'=>'http://thingiverse-production-new.s3.amazonaws.com/renders/71/73/1f/f0/10/1c60646068ae96e9d944ead31ad3c6ec_preview_featured.jpg',
    			'likes'=>3,
    			'messages'=>15,
    			'files'=>2
    		],
    		[
    			'userName'=>'Martin Lechaptois',
    			'projectName'=>'Project De Martin',
    			'projectPic'=>'http://thingiverse-production-new.s3.amazonaws.com/renders/71/73/1f/f0/10/1c60646068ae96e9d944ead31ad3c6ec_preview_featured.jpg',
    			'likes'=>5,
    			'messages'=>9,
    			'files'=>1
    		]];
        return $this->render('CentraleLilleHomepageBundle:Default:index.html.twig',[
        	'weeklyProject' => $weeklyProject,
        	'news' => $news,
        	'thematics' => $thematics,
        	'recentProjects' => $recentProjects,
            'username'=>"Martin"
        ]);
    }
}
