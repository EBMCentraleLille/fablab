<?php
//<<<<<<< 71872a2e747cf024ae6cc231eed8b83ca3bc85b1
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
//=======

//>>>>>>> Fix
namespace CentraleLille\DemoBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
<<<<<<< 71872a2e747cf024ae6cc231eed8b83ca3bc85b1
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
=======
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
>>>>>>> Fix
 */
class CentraleLilleDemoExtension extends Extension
{
    /**
<<<<<<< 71872a2e747cf024ae6cc231eed8b83ca3bc85b1
     * Load
     *
     * {@inheritdoc}
     *
     * @param array            $configs
     * @param ContainerBuilder $container
     *
     * @return something
=======
     * {@inheritdoc}
>>>>>>> Fix
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }
}
