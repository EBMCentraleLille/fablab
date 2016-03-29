<?php
/**
 * FablabRecentProjectService.php Doc
 *
 * Interface relatif aux projets récents
 *
 * PHP Version 5.6
 *
 * @category   File
 * @package    CentraleLille:HomepageBundle
 * @subpackage Services
 * @author     Lechaptois Martin <martin.lechaptois@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link       https://github.com/EBMCentraleLille/fablab
 */
namespace CentraleLille\HomepageBundle\Services;

use Doctrine\Common\Persistence\ObjectManager;
use CentraleLille\CustomFosUserBundle\Entity\Project;
use CentraleLille\HomepageBundle\ServicesInterfaces\FablabRecentProjectInterface;

/**
 * FablabRecentProject Service Doc
 *
 * Interface pour gérer les projets "star"
 *
 * @category   Interface
 * @package    CentraleLille:HomepageBundle
 * @subpackage Services
 * @author     Lechaptois Martin <martin.lechaptois@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link       https://github.com/EBMCentraleLille/fablab
 */
class FablabRecentProject implements FablabRecentProjectInterface
{
    /**
     * Fonction construct de la classe FablabStarProject
     *
     * @param ObjectManager $manager Entité Manager de Doctrine
     *
     * @return void
     */
    public function __construct(ObjectManager $manager)
    {
        $this->em = $manager;
    }

    /**
     * Retourne les projets récémments créés
     *
     * @param integer $limit nombre de projets retournés
     *
     * @return array $recentProjects
     */
    public function getRecentProjects($limit)
    {
        $repository = $this->em->getRepository("CustomFosUserBundle:Project");
        $query = $repository->createQueryBuilder('a')
            ->orderBy('a.dateUpdate', 'DESC')
            ->setMaxResults($limit)
            ->getQuery();
        $recentProjects = $query->getResult();

        return $recentProjects;
    }
}
