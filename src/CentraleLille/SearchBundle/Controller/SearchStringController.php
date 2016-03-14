<?php

namespace CentraleLille\SearchBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use CentraleLille\SearchBundle\Entity\Demo;
use CentraleLille\SearchBundle\Model\SearchString;
use CentraleLille\CustomFosUserBundle\Entity\User;
use CentraleLille\SearchBundle\Form\DemoType;
use CentraleLille\SearchBundle\Form\SearchStringType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\HttpFoundation\JsonResponse;



/**
* SearchUser controller.
*
* @Route("/")
*/


class SearchStringController extends Controller
{

  /**
  *
  * @Route("", name="centrale_lille_searchuser")
  * @Method("GET")
  */
  public function searchAction(Request $request)
  {

    $search = new SearchString();
    $searchForm = $this->get('form.factory')->createNamed(
    '',
    'string_search_type',
    $search,
    array(
      'action' => $this->generateUrl('centrale_lille_searchuser'),
      'method' => 'GET'
      )
    );

    $searchForm->handleRequest($request);
    $search = $searchForm->getData();

    if (is_null($search->getStringSearch())) {
      $result_machine = [];
      $result_user = [];
    } else {

      //User Json
      $queryall = new \Elastica\Query\MatchAll();
      $typeUser = $this->get('fos_elastica.index.fablab.User');
      $result_alluser = $typeUser->search($queryall)->getResults();
      foreach ($result_alluser as $result) {
        $source = $result->getSource();
        $datauser[] = array(
            
            'name' => $source['username'],
            'link'   => 'userId',
        );
    }
     $jsonContentUser = new JsonResponse($datauser, 200, array(
        'Cache-Control' => 'no-cache',
        ));
     //Machine Json
     $queryall = new \Elastica\Query\MatchAll();
      $typeMachine = $this->get('fos_elastica.index.fablab.Machine');
      $result_allmachine = $typeMachine->search($queryall)->getResults();
      


      foreach ($result_allmachine as $result) {
        $source = $result->getSource();
        $type = $result->getType();
        $datamachine[] = array(
           'name' => $source['machine_name'],
            'link'   => 'machineId',
        );
    }
     $jsonContentMachine = new JsonResponse($datamachine, 200, array(
        'Cache-Control' => 'no-cache',
        ));
     $jsonContentMachine = '"machine": '.substr($jsonContentMachine, 83);
     $jsonContentUser = '"user": '.substr($jsonContentUser, 83);
     $jsonTotal = '{'.$jsonContentUser.','.$jsonContentMachine.'}';



      //Recherche User
      $typeUser = $this->get('fos_elastica.index.fablab.User');
      $query_part_user = new \Elastica\Query\BoolQuery();

      $fieldQuery = new \Elastica\Query\Match();
      $fieldQuery2 = new \Elastica\Query\Match();
      $fieldQuery->setFieldQuery('email', $search->getStringSearch());
      $fieldQuery->setFieldFuzziness('email', 0.7);
      $query_part_user->addShould($fieldQuery);
      $fieldQuery2->setFieldQuery('username', $search->getStringSearch());
      $fieldQuery2->setFieldFuzziness('username', 0.7);
      $query_part_user->addShould($fieldQuery2);
      $filters = new \Elastica\Filter\Bool();
      $query_user = new \Elastica\Query\Filtered($query_part_user, $filters);
      $result_user = $typeUser->search($query_user);

    //Recherche Machine
            $typeMachine = $this->get('fos_elastica.index.fablab.Machine');
            $query_part_machine = new \Elastica\Query\Bool();

            $fieldQuery3 = new \Elastica\Query\Match();
            $fieldQuery4 = new \Elastica\Query\Match();
            $fieldQuery3->setFieldQuery('machine_name', $search->getStringSearch());
            $fieldQuery3->setFieldFuzziness('machine_name', 0.7);
            $fieldQuery3->setFieldMinimumShouldMatch('machine_name', '80%');
            $query_part_machine->addShould($fieldQuery3);
            $fieldQuery4->setFieldQuery('description', $search->getStringSearch());
            $fieldQuery4->setFieldFuzziness('description', 2);
            $fieldQuery4->setFieldMinimumShouldMatch('description', '100%');
            $query_part_machine->addShould($fieldQuery4);
       
            $filters = new \Elastica\Filter\Bool();
            $query_machine = new \Elastica\Query\Filtered($query_part_machine, $filters);
            $result_machine = $typeMachine->search($query_machine);

            $encoder = array(new JsonEncoder());
            $normalizer = array(new ObjectNormalizer());
            $serializer = new Serializer($normalizer, $encoder);


           





    }

    return $this->render('CentraleLilleSearchBundle:Default:search.html.twig', array(
      'result_user' => $result_user,
      'result_machine' => $result_machine,
      'result_competence' => [],
      'result_project' => [],
      'form' => $searchForm->createView(),
      'search' => $search->getStringSearch(),
      'userjson' => $jsonContentUser,
      'machinejson' => $jsonContentMachine,
      'jsonTotal' => $jsonTotal,
    ));
  }


  /**
  *
  * @Route("/autocomplete", name="autocomplete")
  */
  public function autocompleteAction()
  {

    //User Json
      $queryall = new \Elastica\Query\MatchAll();
      $typeUser = $this->get('fos_elastica.index.fablab.User');
      $result_alluser = $typeUser->search($queryall)->getResults();
      foreach ($result_alluser as $result) {
        $source = $result->getSource();
        $datauser[] = array(
            
            'name' => $source['username'],
            'link'   => 'userId',
        );
    }
     $jsonContentUser = new JsonResponse($datauser, 200, array(
        'Cache-Control' => 'no-cache',
        ));
     //Machine Json
     $queryall = new \Elastica\Query\MatchAll();
      $typeMachine = $this->get('fos_elastica.index.fablab.Machine');
      $result_allmachine = $typeMachine->search($queryall)->getResults();
      


      foreach ($result_allmachine as $result) {
        $source = $result->getSource();
        $type = $result->getType();
        $datamachine[] = array(
           'name' => $source['machine_name'],
            'link'   => 'machineId',
        );
    }
     $jsonContentMachine = new JsonResponse($datamachine, 200, array(
        'Cache-Control' => 'no-cache',
        ));
     $jsonContentMachine = '"machine": '.substr($jsonContentMachine, 83);
     $jsonContentUser = '"user": '.substr($jsonContentUser, 83);
     $jsonTotal = '{'.$jsonContentUser.','.$jsonContentMachine.'}';




    //get request search
    $search = $this->get('request')->request->get('phrase');


    /*Renvoyer un seul document json avec la structure suivante :
    {
    "user": [
    {"name": "Maxime", "link": "userId"},
    {"name": "Cyprien", "link": "userId"}
  ],
  "machine": [
  {"name": "Impression 3D", "link": "machineId"},
  {"name": "Decoupe Laser", "link": "machineId"}
]
}
*/

$string = $jsonTotal;

return new Response($string);
}
}
