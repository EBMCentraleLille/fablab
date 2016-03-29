<?php
/**
 * CentraleLilleNewsFeed.php File Doc
 *
 * Dependencies pour le bundle NewsFeedBundle
 *
 * PHP Version 5.6
 *
 * @category   File
 * @package    CentraleLille:NewsFeedBundle
 * @subpackage DependencyInjection
 * @author     Lechaptois Martin <martin.lechaptois@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link       https://github.com/EBMCentraleLille/fablab
 */

namespace CentraleLille\NewsFeedBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * CentraleLilleExtension Class Doc
 *
 * Extension for CentraleLilleNewsFeedBundle
 *
 * @category   File
 * @package    CentraleLille:NewsFeedBundle
 * @subpackage DependencyInjection
 * @author     Lechaptois Martin <martin.lechaptois@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link       https://github.com/EBMCentraleLille/fablab
 */
class CentraleLilleExtension extends Extension
{
    /**
     * Load Function Doc
     *
     * Fonction d'injection de dépendance
     *
     * @param array            $configs   configuration
     * @param ContainerBuilder $container container de service
     *
     * @return void
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');
    }
}
