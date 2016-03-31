<?php

namespace CentraleLille\KnowledgeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use CentraleLille\KnowledgeBundle\Entity\Competence;
use CentraleLille\KnowledgeBundle\Form\CompetenceType;

class UserCompetenceController extends Controller
{
    /**
     * @Route("/editcompetences", name="fos_user_profile_edit_competences")
     */
    public function addAction(Request $request)
    {
        $user = $this->getUser();

        $em = $this->getDoctrine()->getManager();

        $listCompetences = $em
            ->getRepository('CentraleLilleKnowledgeBundle:Competence')
            ->findAll();

        $listUserCompetences = $this->container->get('app.competence.service')->getUserCompetenceFromUserList($user);
        $listNotUserCompetences = array();
        foreach ($listCompetences as $competence) {
            $match = false;
            foreach ($listUserCompetences as $userCompetence) {
                if ($userCompetence->getCompetence() == $competence) {
                    $match = true;
                }
            }
            if ($match == false) {
                array_push($listNotUserCompetences, $competence);
            }
        }

        $competence = new Competence();
        $form = $this->get('form.factory')->create(new CompetenceType(), $competence);

        if ($form->handleRequest($request)->isValid()) {

            //Vérification que la compétence existe
            $competenceinDB = $this->getDoctrine()
                ->getRepository('CentraleLilleKnowledgeBundle:Competence')
                ->findOneByName($competence->getName());

            if (is_null($competenceinDB)) {
                $this->addFlash('notice', 'Cette compétence n\'existe pas!');
            } else {
                var_dump($listUserCompetences);
                exit();

                $match = false;
                foreach ($listUserCompetences as $competence) {
                    if ($competenceinDB == $competence) {
                        $match = true;
                    }
                }
                if ($match == false) {
                    $this->container->get('app.competence.service')
                        ->addCompetenceToUser($competenceinDB, $user, $level = 1);
                    $this->addFlash('notice', 'Compétence ajoutée');
                } else {
                    $this->addFlash('notice', 'Compétence déjà attribuée');
                }


            }
        }
        return $this->render(
            'CentraleLilleKnowledgeBundle::editmycompetences.html.twig',
            array('form' => $form->createView(),
                  'userCompetences' => $listUserCompetences,
                  'notUserCompetences' => $listNotUserCompetences)
        );

    }
    /**
     * @Route("/delUserComp/{id}")
     */
    public function deleteAction($id)
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('CentraleLilleKnowledgeBundle:UserCompetence');
        $usercompetence = $repository->find($id);
        $this->container->get('app.competence.service')->deleteCompetenceToUser($usercompetence);
        $this->addFlash('notice', 'Compétence supprimée');

        return $this->redirect(
            $this->generateUrl(
                'fos_user_profile_edit_competences'
            )
        );
    }
    /**
     * @Route("/addUserComp/{id}")
     */
    public function addFromIdAction($id)
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('CentraleLilleKnowledgeBundle:Competence');
        $competence = $repository ->find($id);
        $this->container->get('app.competence.service')->addCompetenceToUser($competence, $user, $level = 1);
        $this->addFlash('notice', 'Compétence ajoutée');

        return $this->redirect(
            $this->generateUrl(
                'fos_user_profile_edit_competences'
            )
        );

    }
}
