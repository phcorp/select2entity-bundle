<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\DependencyInjection\Reference;
use Tetranz\Select2EntityBundle\Form\Type\Select2EntityType;
use Tetranz\Select2EntityBundle\Service\AutocompleteService;

return static function (ContainerConfigurator $container): void {
    $services = $container->services();

    $services->set('tetranz_select2entity.select2entity_type', Select2EntityType::class)
        ->tag('form.type', ['alias' => 'tetranz_select2entity'])
        ->args([
            new Reference('doctrine'),
            new Reference('router'),
            '%tetranz_select2_entity.config%',
        ]);

    $services->set('tetranz_select2entity.autocomplete_service', AutocompleteService::class)
        ->args([
            new Reference('form.factory'),
            new Reference('doctrine'),
        ]);
};
