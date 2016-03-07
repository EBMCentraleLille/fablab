<?php

namespace CentraleLille\SearchBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use CentraleLille\SearchBundle\Extra\Elastic;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{
  /**
  * @Route("/")
  */
  public function indexAction()
  {
    //recherche dans demo seulement
    //$demo = $this->get('fos_elastica.index.fablab.demo');

    //recherche dans tout l'index fablab
    $index = $this->get('fos_elastica.index.fablab');
    $result = $index->search("coucou");
    var_dump($result);

    $response = new JsonResponse();
    $response->setData($result);
    return $response;
  }
}
