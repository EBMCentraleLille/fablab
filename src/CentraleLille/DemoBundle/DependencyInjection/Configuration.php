<?php
/**
 * Configuration File Doc Comment
 *
 * PHP Version 5.5
 *
 * @category Configuration
 * @package  Configuration
 * @author   Display Name <example@example.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/EBMCentraleLille/fablab
 */
namespace CentraleLille\DemoBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Configuration Class Doc Comment
 *
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 *
 * @category Configuration
 * @package  Configuration
 * @author   Display Name <example@example.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/EBMCentraleLille/fablab
 */

class Configuration implements ConfigurationInterface
{
    /**
     * Get Config Tree Builder
     * {@inheritdoc}
     *
     * Description function
     *
     * @return something
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('centrale_lille_demo');

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

        return $treeBuilder;
    }
}
