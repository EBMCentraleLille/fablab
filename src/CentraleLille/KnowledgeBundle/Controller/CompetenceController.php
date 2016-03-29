<?php

namespace CentraleLille\KnowledgeBundle\Controller;

use CentraleLille\KnowledgeBundle\Form\CompetenceType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use CentraleLille\KnowledgeBundle\Entity\Competence;
use Symfony\Component\HttpFoundation\Session\Session;

class CompetenceController extends Controller
{
    /**
     * @Route("/add", name="centrale_lille_knowledge_add_competence")
     */
    public function addAction(Request $request)
    {
        $competence = new Competence();
        $form = $this->get('form.factory')->create(new CompetenceType(), $competence);

        if ($form->handleRequest($request)->isValid()) {
            //Vérification doublon
            $competenceinDB = $this->getDoctrine()
                ->getRepository('CentraleLilleKnowledgeBundle:Competence')
                ->findOneByName($competence->getName());
            if(is_null($competenceinDB)){
                //persist de la compétence
                $this->container->get('app.competence.service')->createCompetence($competence->getName());
                $request->getSession()->getFlashBag()->add('notice', 'Compétence bien enregistrée.');
            }else{
                $request->getSession()->getFlashBag()->add('notice', 'Cette compétence existe déjà.');
            }
        }
        return $this->render(
            'CentraleLilleKnowledgeBundle::addcompetence.html.twig',
            array('form' => $form->createView())
        );
    }
    /**
     * @Route("/competences", name="centrale_lille_knowledge_competences")
     */
    public function listCompetencesAction(){

        $competences = $this->container->get('app.competence.service')->getCompetenceList();
        return $this->render(
            'CentraleLilleKnowledgeBundle::competences.html.twig',
            array('competences'=>$competences)
        );

    }
    /**
     * @Route("/delComp/{id}")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('CentraleLilleKnowledgeBundle:Competence');
        $competence = $repository->find($id);

        $listUserCompetences = $em
            ->getRepository('CentraleLilleKnowledgeBundle:UserCompetence')
            ->findAllCompetencesInUserCompetencesDQL($competence);

        foreach($listUserCompetences as $userCompetence){
            $this->container->get('app.competence.service')->deleteCompetenceToUser($userCompetence);
        }

        $this->container->get('app.competence.service')->deleteCompetence($competence);

        return $this->redirect(
            $this->generateUrl(
                'centrale_lille_knowledge_competences'
            )
        );
    }
}
