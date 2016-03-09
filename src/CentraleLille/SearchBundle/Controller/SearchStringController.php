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

/**
* SearchUser controller.
*
* @Route("/")
*/


class SearchStringController extends Controller
{

  /**
  *
  * @Route("/user", name="centrale_lille_searchuser")
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
        } else

         {

        //Recherche User
        $typeUser = $this->get('fos_elastica.index.fablab.User');
        $query_part_user = new \Elastica\Query\BoolQuery();

        $fieldQuery = new \Elastica\Query\Match();
        $fieldQuery2 = new \Elastica\Query\Match();
        $fieldQuery->setFieldQuery('email', $search->getStringSearch());
        $fieldQuery->setFieldQuery('email', $search->getStringSearch());
        $fieldQuery->setFieldFuzziness('email', 0.7);
        $query_part_user->addShould($fieldQuery);
        $fieldQuery2->setFieldQuery('username', $search->getStringSearch());
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








 //Recherche Machine
        $typeMachine = $this->get('fos_elastica.index.fablab.Machine');
        $query_part_machine = new \Elastica\Query\Bool();

        $fieldQuery3 = new \Elastica\Query\Match();
        $fieldQuery4 = new \Elastica\Query\Match();
        $fieldQuery3->setFieldQuery('machine_name', $search->getStringSearch());
       // $fieldQuery3->setFieldFuzziness('machine.machine_name', 0.7);
        //$fieldQuery3->setFieldMinimumShouldMatch('machine_name', '80%');
        $query_part_machine->addShould($fieldQuery3);
        $fieldQuery4->setFieldQuery('description', $search->getStringSearch());
       // $fieldQuery4->setFieldFuzziness('machine.machine_name', 0.7);
       //$fieldQuery4->setFieldMinimumShouldMatch('machine_name', '100%');
        $query_part_machine->addShould($fieldQuery4);





        }

        return $this->render('CentraleLilleSearchBundle:Default:search.html.twig', array(
        'result_user' => $result_user,
        'result_machine' => $result_machine,
        'form' => $searchForm->createView(),
        'search' => $search->getStringSearch(),
        ));
    }
}
