<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Tmdb\Client;
use Tmdb\Repository\AccountRepository;
use Tmdb\Repository\AuthenticationRepository;
use Tmdb\Repository\CertificationRepository;
use Tmdb\Repository\ChangesRepository;
use Tmdb\Repository\CollectionRepository;
use Tmdb\Repository\CompanyRepository;
use Tmdb\Repository\ConfigurationRepository;
use Tmdb\Repository\CreditsRepository;
use Tmdb\Repository\DiscoverRepository;
use Tmdb\Repository\FindRepository;
use Tmdb\Repository\GenreRepository;
use Tmdb\Repository\JobsRepository;
use Tmdb\Repository\KeywordRepository;
use Tmdb\Repository\ListRepository;
use Tmdb\Repository\MovieRepository;
use Tmdb\Repository\NetworkRepository;
use Tmdb\Repository\PeopleRepository;
use Tmdb\Repository\ReviewRepository;
use Tmdb\Repository\SearchRepository;
use Tmdb\Repository\TvEpisodeRepository;
use Tmdb\Repository\TvRepository;
use Tmdb\Repository\TvSeasonRepository;

return static function (ContainerConfigurator $container): void {
    $services = $container->services();

    $services->defaults()
        ->public();

    $services->set(AuthenticationRepository::class)->arg(0, service(Client::class));
    $services->set(AccountRepository::class)->arg(0, service(Client::class));
    $services->set(CertificationRepository::class)->arg(0, service(Client::class));
    $services->set(ChangesRepository::class)->arg(0, service(Client::class));
    $services->set(CollectionRepository::class)->arg(0, service(Client::class));
    $services->set(CompanyRepository::class)->arg(0, service(Client::class));
    $services->set(ConfigurationRepository::class)->arg(0, service(Client::class));
    $services->set(CreditsRepository::class)->arg(0, service(Client::class));
    $services->set(DiscoverRepository::class)->arg(0, service(Client::class));
    $services->set(FindRepository::class)->arg(0, service(Client::class));
    $services->set(GenreRepository::class)->arg(0, service(Client::class));
    $services->set(JobsRepository::class)->arg(0, service(Client::class));
    $services->set(KeywordRepository::class)->arg(0, service(Client::class));
    $services->set(ListRepository::class)->arg(0, service(Client::class));
    $services->set(MovieRepository::class)->arg(0, service(Client::class));
    $services->set(NetworkRepository::class)->arg(0, service(Client::class));
    $services->set(PeopleRepository::class)->arg(0, service(Client::class));
    $services->set(ReviewRepository::class)->arg(0, service(Client::class));
    $services->set(SearchRepository::class)->arg(0, service(Client::class));
    $services->set(TvRepository::class)->arg(0, service(Client::class));
    $services->set(TvEpisodeRepository::class)->arg(0, service(Client::class));
    $services->set(TvSeasonRepository::class)->arg(0, service(Client::class));
};
