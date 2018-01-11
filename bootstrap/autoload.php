<?php

$root = dirname(__DIR__);

require "{$root}/vendor/autoload.php";

$builder = new \DI\ContainerBuilder();
$builder->useAutowiring(true);

$builder->addDefinitions([

    \Demo\Commands\ValidationCommand::class => DI\object()
        ->constructor(
            DI\get(\Demo\FileSystem::class),
            DI\get(\Demo\Validator\StringValidatorBuilderFactory::class)
        ),

]);

$container = $builder->build();