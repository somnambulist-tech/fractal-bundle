<?php declare(strict_types=1);

namespace Somnambulist\Bundles\FractalBundle;

use League\Fractal\Manager;
use League\Fractal\Resource\ResourceInterface;
use League\Fractal\Scope;
use League\Fractal\ScopeFactoryInterface;
use Symfony\Component\DependencyInjection\ServiceLocator;

class ScopeFactory implements ScopeFactoryInterface
{
    public function __construct(
        private ServiceLocator $transformers
    ) {
    }

    public function createScopeFor(Manager $manager, ResourceInterface $resource, string $scopeIdentifier = null): Scope
    {
        return new TransformerLocatingScope($this->transformers, $manager, $resource, $scopeIdentifier);
    }

    public function createChildScopeFor(Manager $manager, Scope $parentScope, ResourceInterface $resource, string $scopeIdentifier = null): Scope
    {
        $scopeInstance = $this->createScopeFor($manager, $resource, $scopeIdentifier);

        // This will be the new children list of parents (parents parents, plus the parent)
        $scopeArray   = $parentScope->getParentScopes();
        $scopeArray[] = $parentScope->getScopeIdentifier();

        $scopeInstance->setParentScopes($scopeArray);

        return $scopeInstance;
    }
}
