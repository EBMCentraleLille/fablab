<?php

namespace CentraleLille\SearchBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use CentraleLille\SearchBundle\Entity\Demo;
use CentraleLille\SearchBundle\Model\SearchUser;
use CentraleLille\CustomFosUserBundle\Entity\User;
use CentraleLille\SearchBundle\Form\DemoType;
use CentraleLille\SearchBundle\Form\SearchUserType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
* SearchUser controller.
*
* @Route("/")
*/


class SearchUserController extends Controller
{

  /**
  *
  * @Route("/user", name="centrale_lille_searchuser")
  * @Method("GET")
  */
    public function searchAction(Request $request)
    {

        $search = new SearchUser();
        $searchForm = $this->get('form.factory')->createNamed(
            '',
            'user_search_type',
            $search,
            array(
            'action' => $this->generateUrl('centrale_lille_searchuser'),
            'method' => 'GET'
            )
        );

        $searchForm->handleRequest($request);
        $search = $searchForm->getData();

        if (is_null($search->getUsername())) {
            $results = [];
        } else {
            $elasticaManager = $this->container->get('fos_elastica.manager');
            $results = $elasticaManager->getRepository('CustomFosUserBundle:User')->search($search);
        }

        return $this->render('CentraleLilleSearchBundle:Default:search.html.twig', array(
        'results' => $results,
        'form' => $searchForm->createView(),
        ));
    }
}
