<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Tmdb\Client;
use Tmdb\Event\Listener\Logger\LogApiErrorListener;
use Tmdb\Event\Listener\Logger\LogHttpMessageListener;
use Tmdb\Event\Listener\Logger\LogHydrationListener;
use Tmdb\Event\Listener\Psr6CachedRequestListener;
use Tmdb\Event\Listener\Request\AcceptJsonRequestListener;
use Tmdb\Event\Listener\Request\ApiTokenRequestListener;
use Tmdb\Event\Listener\Request\ContentTypeJsonRequestListener;
use Tmdb\Event\Listener\Request\UserAgentRequestListener;
use Tmdb\Event\Listener\RequestListener;
use Tmdb\Formatter\HttpMessage\FullHttpMessageFormatter;
use Tmdb\Formatter\HttpMessage\SimpleHttpMessageFormatter;
use Tmdb\Formatter\Hydration\SimpleHydrationFormatter;
use Tmdb\Formatter\TmdbApiException\SimpleTmdbApiExceptionFormatter;
use Tmdb\HttpClient\HttpClient;
use Tmdb\SymfonyBundle\ClientConfiguration;
use Tmdb\Token\Api\ApiToken;
use Tmdb\Token\Api\BearerToken;

return static function (ContainerConfigurator $container): void {
    $services = $container->services();

    $services->set(Client::class)
        ->public()
        ->arg(0, service(ClientConfiguration::class));

    $services->set(ApiToken::class)
        ->arg(0, param('tmdb.api_token'));

    $services->set(BearerToken::class)
        ->arg(0, param('tmdb.bearer_token'));

    $services->set(HttpClient::class)
        ->factory([service(Client::class), 'getHttpClient']);

    // Listeners
    $services->set(RequestListener::class, RequestListener::class)
        ->arg(0, service(HttpClient::class))
        ->arg(1, null);

    $services->set(ApiTokenRequestListener::class, ApiTokenRequestListener::class)
        ->arg(0, service(ApiToken::class));

    $services->set(ContentTypeJsonRequestListener::class, ContentTypeJsonRequestListener::class);
    $services->set(AcceptJsonRequestListener::class, AcceptJsonRequestListener::class);
    $services->set(UserAgentRequestListener::class, UserAgentRequestListener::class)
        ->arg(0, null);

    // This services will be filled by the ConfigurationPass
    $services->set(ClientConfiguration::class)
        ->arg(0, service(ApiToken::class))
        ->arg(1, null) // PSR-14 Event dispatcher
        ->arg(2, null) // PSR-18 HTTP Client
        ->arg(3, null) // PSR-17 Request Factory
        ->arg(4, null) // PSR-17 Response Factory
        ->arg(5, null) // PSR-17 Stream Factory
        ->arg(6, null) // PSR-17 Uri Factory
        ->arg(7, param('tmdb.client.options'));

    // These services will be filled by the EventDispatchingCompilerPass
    $services->set(Psr6CachedRequestListener::class, Psr6CachedRequestListener::class)
        ->arg(0, service(HttpClient::class))
        ->arg(1, null)
        ->arg(2, null)
        ->arg(3, null)
        ->arg(4, param('tmdb.client.options'));

    $services->set(LogHttpMessageListener::class, LogHttpMessageListener::class)
        ->arg(0, null)
        ->arg(1, null);

    $services->set(LogHydrationListener::class, LogHydrationListener::class)
        ->arg(0, null)
        ->arg(1, null)
        ->arg(2, null);

    $services->set(LogApiErrorListener::class, LogApiErrorListener::class)
        ->arg(0, null)
        ->arg(1, null);

    // Formatters
    $services->set(SimpleHttpMessageFormatter::class);
    $services->set(FullHttpMessageFormatter::class);
    $services->set(SimpleHydrationFormatter::class);
    $services->set(SimpleTmdbApiExceptionFormatter::class);
};
