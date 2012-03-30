<?php
namespace Mopa\Bundle\BootstrapBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class MopaBootstrapExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $yamlloader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));

        if(isset($config['twig'])){
            $yamlloader->load("twig_extensions.yml");
            $globals = array(
                'layoutTemplate' => $config['twig']['layoutTemplate']
            );
            $container->setParameter(
                'mopa_bootstrap.globals',
                $globals
            );
        }

        if(isset($config['form'])){
            $yamlloader->load("form_extensions.yml");
            if(isset($config['form']['render_fieldset'])){
                $container->setParameter(
                    'mopa_bootstrap.form.render_fieldset',
                    $config['form']['render_fieldset']
                );
            }
            if(isset($config['form']['show_legend'])){
                $container->setParameter(
                    'mopa_bootstrap.form.show_legend',
                    $config['form']['show_legend']
                );
            }
            if(isset($config['form']['show_child_legend'])){
                $container->setParameter(
                    'mopa_bootstrap.form.show_child_legend',
                    $config['form']['show_child_legend']
                );
            }
            if(isset($config['form']['error_type'])){
                $container->setParameter(
                    'mopa_bootstrap.form.error_type',
                    $config['form']['error_type']
                );
            }

        }

        if(isset($config['navbar'])){
            $yamlloader->load("navbar_extension.yml");
            if(isset($config['navbar']['template'])){
                $container->setParameter(
                    'mopa_bootstrap.navbar.template',
                    $config['navbar']['template']
                );
            }
        }
    }
}
