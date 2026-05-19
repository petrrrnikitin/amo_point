<?php

namespace App\Dogs\Commands;

use App\Dogs\ApiClients\Contracts\DogApiClientInterface;
use App\Dogs\DTOs\DogDto;
use App\Dogs\Services\DogService;
use Illuminate\Console\Command;
use Illuminate\Support\LazyCollection;

use function count;

class FetchDogsCommand extends Command
{
    protected $signature = 'dogs:fetch';

    protected $description = 'Fetch dog breeds from The Dog API and store them in the database';

    private const int PAGE_SIZE = 10;

    public function __construct(
        private readonly DogApiClientInterface $client,
        private readonly DogService $service,
    ) {
        parent::__construct();
    }

    public function handle(): void
    {
        $breeds = LazyCollection::make(function () {
            $pageNumber = 0;

            while (true) {
                $pageBreeds = $this->client->fetchBreeds($pageNumber++, self::PAGE_SIZE);

                foreach ($pageBreeds as $breed) {
                    yield DogDto::fromApiResponse($breed);
                }

                if (count($pageBreeds) < self::PAGE_SIZE) {
                    break;
                }
            }
        });

        $this->service->store($breeds);

        $this->info('Done.');
    }
}
