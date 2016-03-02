<?php
/**
 * src/CentraleLille/NewsFeedBundle/DependencyInjection/CentraleLilleNewsFeed.php
 * CentraleLilleNewsFeed.php File Doc
 *
 * Dependencies pour le bundle NewsFeedBundle
 *
 * PHP Version 5.6
 *
 * @package  	CentraleLille
 * @subpackage 	NewsFeedBundle
 * @category 	DependencyInjection
 * @author   	Lechaptois Martin <martin.lechaptois@gmail.com>
 * @license  	http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     	https://github.com/EBMCentraleLille/fablab
 */

namespace CentraleLille\NewsFeedBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

class CentraleLilleExtension extends Extension
{
  public function load(array $configs, ContainerBuilder $container)
  {
    $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
    $loader->load('services.yml');
  }
}