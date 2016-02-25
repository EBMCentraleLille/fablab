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
    $es = new Elastic($this->container);

    //récupérer donnée formulaire
    //$request = $this->getRequest();
    //$post = $request->query;

    $data = $es->simpleSearch("Coucou");

    $response = new JsonResponse();
    $response->setData($data);
    return $response;
  }
}
