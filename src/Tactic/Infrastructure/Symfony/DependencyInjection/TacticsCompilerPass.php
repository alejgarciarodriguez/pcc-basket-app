<?php

namespace Alejgarciarodriguez\PccBasketApp\Tactic\Infrastructure\Symfony\DependencyInjection;

use Alejgarciarodriguez\PccBasketApp\Tactic\Domain\TacticCollector;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class TacticsCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        // always first check if the primary service is defined
        if (!$container->has(TacticCollector::class)) {
            return;
        }

        $definition = $container->findDefinition(TacticCollector::class);

        // find all service IDs with the app.mail_transport tag
        $taggedServices = $container->findTaggedServiceIds('app.tactics');

        foreach ($taggedServices as $id => $tags) {
            // add the transport service to the TransportChain service
            $definition->addMethodCall('addTactic', [new Reference($id)]);
        }
    }
}