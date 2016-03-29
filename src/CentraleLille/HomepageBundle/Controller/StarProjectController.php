<?php
/**
 * StarProjectController.php File Doc
 *
 * Controller permettant la gestion des StarProject
 *
 * PHP Version 5.6
 *
 * @category   File
 * @package    CentraleLille:HomepageBundle
 * @subpackage Controller
 * @author     Lechaptois Martin <martin.lechaptois@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link       https://github.com/EBMCentraleLille/fablab
 */

namespace CentraleLille\HomepageBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CentraleLille\HomepageBundle\Entity\StarProject;
use CentraleLille\HomepageBundle\Form\StarProjectType;

/**
 * StarProjectController Class Doc
 *
 * Controller permettant la gestion des StarProject
 *
 * @category   Controller
 * @package    CentraleLille:HomepageBundle
 * @subpackage Controller
 * @author     Lechaptois Martin <martin.lechaptois@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link       https://github.com/EBMCentraleLille/fablab
 */
class StarProjectController extends Controller
{
    /**
    * IndexAction Function Doc
    *
    * Présentation de tous les starprojets
    *
    * @param Object $request Requête HTTP
    *
    * @return Twig La vue Twig à display
    */
    public function indexAction(Request $request)
    {
        $user = $this->getUser();
        
        if (!$user) {
            $session=$request->getSession()->getFlashBag()->add(
                'notice',
                "Vous devez être connecté pour accéder à cette page."
            );
            return $this->redirectToRoute('fos_user_security_login');
        } elseif (!$this->get('security.context')->isGranted('ROLE_ADMIN')) {
            $session=$request->getSession()->getFlashBag()->add(
                'notice',
                "Vous n'avez pas les droits d'accéder à cette page."
            );
            return $this->redirectToRoute('fos_user_profile_show');
        } else {
            //Récupération des star project
            $starProjectService=$this->container->get('fablab_homepage.starProject');
            $starProjects=$starProjectService->getAllStarProjects();
            
            $starProjects= array_reverse($starProjects);

            return $this->render(
                'CentraleLilleHomepageBundle:starproject.html.twig',
                [
                    'starProjects' => $starProjects
                ]
            );
        }
    }

    /**
    * CreateAction Function Doc
    *
    * Fonction d'ajout de star project
    *
    * @param Object $request Requête HTTP
    *
    * @return Twig La vue Twig à display
    */
    public function createAction(Request $request)
    {
        $user = $this->getUser();
        
        if (!$user) {
            $session=$request->getSession()->getFlashBag()->add(
                'notice',
                "Vous devez être connecté pour accéder à cette page."
            );
            return $this->redirectToRoute('fos_user_security_login ');
        } elseif (!$this->get('security.context')->isGranted('ROLE_ADMIN')) {
            $session=$request->getSession()->getFlashBag()->add(
                'notice',
                "Vous n'avez pas les droits d'accéder à cette page."
            );
            return $this->redirectToRoute('fos_user_profile_show');
        } else {
            $starProject = new StarProject();
            $form = $this->createForm(StarProjectType::class, $starProject);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($starProject);
                $em->flush();
                $session=$request->getSession()->getFlashBag()->add(
                    'notice',
                    "Le projet star a bien été ajouté."
                );

                return $this->redirect(
                    $this->generateUrl(
                        'centrale_lille_homepage_star_project'
                    )
                );
            }
            
            return $this->render(
                'CentraleLilleHomepageBundle:newstarproject.html.twig',
                array(
                'form' => $form->createView()
                )
            );
        }
    }
}
