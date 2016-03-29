<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new AppBundle\AppBundle(),
            new CentraleLille\GdpBundle\CentraleLilleGdpBundle(),
            new FOS\RestBundle\FOSRestBundle(),
            new Nelmio\ApiDocBundle\NelmioApiDocBundle(),
            // new JMS\SecurityExtraBundle\JMSSecurityExtraBundle(),
            new JMS\AopBundle\JMSAopBundle(),
            new JMS\DiExtraBundle\JMSDiExtraBundle($this),
            new CentraleLille\CustomFosUserBundle\CustomFosUserBundle(),
            new FOS\UserBundle\FOSUserBundle(),
            new CentraleLille\SearchBundle\CentraleLilleSearchBundle(),
            new FOS\ElasticaBundle\FOSElasticaBundle(),
            new JMS\SerializerBundle\JMSSerializerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new CentraleLille\KnowledgeBundle\CentraleLilleKnowledgeBundle(),
            new CentraleLille\ReservationBundle\ReservationBundle(),
            new CentraleLille\HomepageBundle\CentraleLilleHomepageBundle(),
            new CentraleLille\ProjectPageBundle\ProjectPageBundle(),
            new CentraleLille\NewsFeedBundle\CentraleLilleNewsFeedBundle(),
            new Lexik\Bundle\JWTAuthenticationBundle\LexikJWTAuthenticationBundle(),
            new Gesdinet\JWTRefreshTokenBundle\GesdinetJWTRefreshTokenBundle(),
            new FOS\JsRoutingBundle\FOSJsRoutingBundle(),
            new ADesigns\CalendarBundle\ADesignsCalendarBundle(),
        );
        if (in_array($this->getEnvironment(), array('dev', 'test'), true)) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
            $bundles[] = new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle();
        }
        return $bundles;
    }
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir().'/config/config_'.$this->getEnvironment().'.yml');
    }
}
