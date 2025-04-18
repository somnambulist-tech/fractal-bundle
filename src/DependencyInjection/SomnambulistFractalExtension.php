<?php declare(strict_types=1);

namespace Somnambulist\Bundles\FractalBundle\DependencyInjection;

use League\Fractal\TransformerAbstract;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class SomnambulistFractalExtension extends Extension
{
    public const TRANSFORMER_TAG_NAME = 'somnambulist.fractal_bundle.transformer';

    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        $container->registerForAutoconfiguration(TransformerAbstract::class)->addTag(self::TRANSFORMER_TAG_NAME);
    }
}
