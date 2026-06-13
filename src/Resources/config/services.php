<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use League\Fractal\Manager;
use League\Fractal\ScopeFactoryInterface;
use Somnambulist\Bundles\FractalBundle\ScopeFactory;

return static function (ContainerConfigurator $container) {
    $services = $container->services();
    $parameters = $container->parameters();

    $services
        ->defaults()
        ->private()
        ->autowire()
        ->autoconfigure()
    ;

    $services->set(Manager::class, Manager::class)->public();

    $services->alias('somnambulist.fractal_bundle.manager', Manager::class)->public();

    $services
        ->set(ScopeFactory::class, ScopeFactory::class)
        ->arg('$transformers', tagged_locator('somnambulist.fractal_bundle.transformer'))
    ;

    $services->alias(ScopeFactoryInterface::class, ScopeFactory::class);
};
