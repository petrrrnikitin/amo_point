<?php

namespace App\Dogs\Providers;

use App\Dogs\ApiClients\Contracts\DogApiClientInterface;
use App\Dogs\ApiClients\DogApiClient;
use App\Dogs\Commands\FetchDogsCommand;
use App\Dogs\Repositories\Contracts\DogRepositoryInterface;
use App\Dogs\Repositories\EloquentDogRepository;
use Illuminate\Support\ServiceProvider;

class DogServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(DogApiClientInterface::class, fn() => new DogApiClient(
            config('services.dog_api.base_url'),
            config('services.dog_api.key'),
        ));

        $this->app->bind(DogRepositoryInterface::class, EloquentDogRepository::class);
    }

    public function boot(): void
    {
        $this->commands([FetchDogsCommand::class]);
    }
}