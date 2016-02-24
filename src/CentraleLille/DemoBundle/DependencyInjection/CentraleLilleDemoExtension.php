<?php
/**
 * CentraleLilleDemoExtension File Doc Comment
 *
 * PHP Version 5.5
 *
 * @category CentraleLilleDemoExtension
 * @package  CentraleLilleDemoExtension
 * @author   Display Name <ml.94230@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/EBMCentraleLille/fablab
 */
namespace CentraleLille\DemoBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * CentraleLilleDemoExtension Class Doc Comment
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 *
 * @category CentraleLilleDemoExtension
 * @package  CentraleLilleDemoExtension
 * @author   Display Name <ml.94230@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/EBMCentraleLille/fablab
 */
class CentraleLilleDemoExtension extends Extension
{
    /**
     * Load
     *
     * {@inheritdoc}
     *
     * @param array            $configs
     * @param ContainerBuilder $container
     *
     * @return something
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }
}
