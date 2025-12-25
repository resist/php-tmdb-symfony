<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Tmdb\Client;
use Tmdb\SymfonyBundle\Twig\TmdbExtension;

return static function (ContainerConfigurator $container): void {
    $services = $container->services();

    $services->set(TmdbExtension::class)
        ->arg(0, service(Client::class))
        ->tag('twig.extension');
};
