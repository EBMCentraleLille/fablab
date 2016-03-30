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
use ADesigns\CalendarBundle\ADesignsCalendarBundle;
use FOS\JsRoutingBundle\FOSJsRoutingBundle;

/**
* SearchUser controller.
*
* @Route("/")
*/


class SearchStringController extends Controller
{
    /**
    *
    * @Route("", name="centrale_lille_search")
    */
    public function searchAction()
    {

        $jsonContentUser = '';
        $jsonContentMachine = '';
        $jsonContentProjet = '';
        $jsonContentSkills = '';
        $jsonTotal = '';
        $datauser = [];
        $dataprojet = [];
        $dataskills = [];
        $datamachine = [];

        $search = $this->get('request')->query->get('searchForm');

        if (is_null($search)) {
            $result_machine = [];
            $result_user = [];
            $result_skills = [];
            $result_projet = [];
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

            //Project Json
            $queryall = new \Elastica\Query\MatchAll();
            $typeProjet = $this->get('fos_elastica.index.fablab.Projet');
            $result_allprojet = $typeProjet->search($queryall)->getResults();
            foreach ($result_allprojet as $result) {
                $source = $result->getSource();
                $dataprojet[] = array(

                'name' => $source['name'],
                'link'   => 'projectId',
                );
            }
            $jsonContentProjet = new JsonResponse($dataprojet, 200, array(
            'Cache-Control' => 'no-cache',
            ));

            //Skills Json
            $queryall = new \Elastica\Query\MatchAll();
            $typeSkills = $this->get('fos_elastica.index.fablab.Competence');
            $result_allskills = $typeSkills->search($queryall)->getResults();
            foreach ($result_allskills as $result) {
                $source = $result->getSource();
                $dataskills[] = array(
                'name' => $source['name'],
                'link'   => 'skillsId',
                );
            }
            $jsonContentSkills = new JsonResponse($dataskills, 200, array(
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
                'name' => $source['name'],
                'link'   => 'machineId',
                );
            }
            $jsonContentMachine = new JsonResponse($datamachine, 200, array(
            'Cache-Control' => 'no-cache',
            ));
            $jsonContentMachine = '"machine": '.substr($jsonContentMachine, 83);
            $jsonContentUser = '"user": '.substr($jsonContentUser, 83);
            $jsonContentSkills = '"competence": '.substr($jsonContentSkills, 83);
            $jsonContentProjet = '"projet": '.substr($jsonContentProjet, 83);
            $jsonTotal = '{'.$jsonContentUser.','.$jsonContentMachine.','.$jsonContentProjet.','.$jsonContentSkills.'}';



            //Recherche User
            $typeUser = $this->get('fos_elastica.index.fablab.User');
            $query_part_user = new \Elastica\Query\BoolQuery();

            $fieldQuery = new \Elastica\Query\Match();
            $fieldQuery2 = new \Elastica\Query\Match();
            $fieldQuery9 = new \Elastica\Query\Match();
            $fieldQuery10 = new \Elastica\Query\Match();
           

            $fieldQuery->setFieldQuery('email', $search);
            $fieldQuery->setFieldFuzziness('email', 0.2);
            $query_part_user->addShould($fieldQuery);
            $fieldQuery9->setFieldQuery('firstname', $search);
            $fieldQuery9->setFieldFuzziness('firstname', 0.2);
            $query_part_user->addShould($fieldQuery9);
            $fieldQuery10->setFieldQuery('lastname', $search);
            $fieldQuery10->setFieldFuzziness('lastname', 0.2);
            $query_part_user->addShould($fieldQuery10);
            $fieldQuery2->setFieldQuery('username', $search);
            $fieldQuery2->setFieldFuzziness('username', 0.2);

            $query_part_user->addShould($fieldQuery2);
            $filters = new \Elastica\Filter\Bool();
            $query_user = new \Elastica\Query\Filtered($query_part_user, $filters);
            $result_user = $typeUser->search($query_user);

          //Recherche Machine
            $typeMachine = $this->get('fos_elastica.index.fablab.Machine');
            $query_part_machine = new \Elastica\Query\Bool();

            $fieldQuery3 = new \Elastica\Query\Match();
            $fieldQuery4 = new \Elastica\Query\Match();
            $fieldQuery3->setFieldQuery('name', $search);
            $fieldQuery3->setFieldFuzziness('name', 0.2);
            $fieldQuery3->setFieldMinimumShouldMatch('name', '80%');
            $query_part_machine->addShould($fieldQuery3);
            $fieldQuery4->setFieldQuery('description', $search);
            $fieldQuery4->setFieldFuzziness('description', 2);
            $fieldQuery4->setFieldMinimumShouldMatch('description', '100%');
             $query_part_machine->addShould($fieldQuery4);



            $filters = new \Elastica\Filter\Bool();
            $query_machine = new \Elastica\Query\Filtered($query_part_machine, $filters);
            $result_machine = $typeMachine->search($query_machine);



              //Recherche Skills
            $typeSkills = $this->get('fos_elastica.index.fablab.Competence');
            $query_part_skills = new \Elastica\Query\Bool();

            $fieldQuery5 = new \Elastica\Query\Match();
            $fieldQuery5->setFieldQuery('name', $search);
            $fieldQuery5->setFieldFuzziness('name', 2);
            $fieldQuery5->setFieldMinimumShouldMatch('name', '40%');
            $query_part_skills->addShould($fieldQuery5);



            $filters = new \Elastica\Filter\Bool();
            $query_skills = new \Elastica\Query\Filtered($query_part_skills, $filters);
            $result_skills = $typeSkills->search($query_skills);


              //Recherche projet
            $typeProjet = $this->get('fos_elastica.index.fablab.Projet');


            $query_part_projet = new \Elastica\Query\Bool();

            $fieldQuery6 = new \Elastica\Query\Match();
            $fieldQuery7 = new \Elastica\Query\Match();
            $fieldQuery6->setFieldQuery('name', $search);
            $fieldQuery6->setFieldFuzziness('name', 0.2);
            $fieldQuery6->setFieldMinimumShouldMatch('name', '80%');
            $query_part_projet->addShould($fieldQuery6);
            $fieldQuery7->setFieldQuery('summary', $search);
            $fieldQuery7->setFieldFuzziness('summary', 2);
            $fieldQuery7->setFieldMinimumShouldMatch('summary', '100%');
            $query_part_projet->addShould($fieldQuery7);
            $filters = new \Elastica\Filter\Bool();
            $query_projet = new \Elastica\Query\Filtered($query_part_projet, $filters);






            $result_projet = $typeProjet->search($query_projet);

    //
            $encoder = array(new JsonEncoder());
            $normalizer = array(new ObjectNormalizer());
            $serializer = new Serializer($normalizer, $encoder);
        }
        return $this->render('CentraleLilleSearchBundle:Default:search.html.twig', array(
        'result_user' => $result_user,
        'result_machine' => $result_machine,
        'result_competence' => $result_skills,
        'result_project' => $result_projet,
        'search' => $search,
        'userjson' => $jsonContentUser,
        'machinejson' => $jsonContentMachine,
        'jsonTotal' => $jsonTotal
        ));

    }


    /**
    *
    * @Route("/autocomplete", name="autocomplete")
    */
    public function autocompleteAction()
    {
        $search = $this->get('request')->request->get('phrase');
        $datauser = [];
        $dataprojet = [];
        $dataskills = [];
        $datamachine = [];
        //User Json
           $queryall = new \Elastica\Query\MatchAll();

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

            //Project Json
            $queryall = new \Elastica\Query\MatchAll();
            $typeProjet = $this->get('fos_elastica.index.fablab.Projet');
            $result_allprojet = $typeProjet->search($queryall)->getResults();
            foreach ($result_allprojet as $result) {
                $source = $result->getSource();
                $dataprojet[] = array(
                'name' => $source['name'],
                'link' => $this->generateUrl('project_show', array('projectId' => $source['id'] )),
                );
            }
            $jsonContentProjet = new JsonResponse($dataprojet, 200, array(
            'Cache-Control' => 'no-cache',
            ));

            //Skills Json
            $queryall = new \Elastica\Query\MatchAll();
            $typeSkills = $this->get('fos_elastica.index.fablab.Competence');
            $result_allskills = $typeSkills->search($queryall)->getResults();
            foreach ($result_allskills as $result) {
                $source = $result->getSource();
                $dataskills[] = array(

                'name' => $source['name'],
                'link'   => 'skillsId',
                );
            }
            $jsonContentSkills = new JsonResponse($dataskills, 200, array(
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
                'name' => $source['name'],
                'link'   => $this->generateUrl(
                    'centrale_lille_view_resource',
                    array('resourceType' => 'machine', 'id' => $source['id'] )
                ),
                );
            }
            $jsonContentMachine = new JsonResponse($datamachine, 200, array(
            'Cache-Control' => 'no-cache',
            ));
            $jsonContentMachine = '"machine": '.substr($jsonContentMachine, 83);
            $jsonContentUser = '"user": '.substr($jsonContentUser, 83);
            $jsonContentSkills = '"competence": '.substr($jsonContentSkills, 83);
            $jsonContentProjet = '"projet": '.substr($jsonContentProjet, 83);
            $jsonTotal = '{'.$jsonContentUser.','.$jsonContentMachine.','.$jsonContentProjet.','.$jsonContentSkills.'}';

            $string = $jsonTotal;

            return new Response($string);
    }


    /**
    * @Route("/js/search.js", name="js_search")
    */
    public function jsSearchAction()
    {
        $content = $this->renderView('CentraleLilleSearchBundle:Js:search.js.twig');
        $response = new Response($content);
        $response->headers->set('Content-Type', 'text/javascript');
        return $response;
    }
}
