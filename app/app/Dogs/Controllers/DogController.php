<?php

namespace App\Dogs\Controllers;

use App\Dogs\Resources\DogResource;
use App\Dogs\Services\DogService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use OpenApi\Attributes as OA;

class DogController
{
    public function __construct(
        private readonly DogService $service,
    ) {}

    #[OA\Get(
        path: '/dogs',
        summary: 'Get all dog breeds',
        tags: ['Dogs'],
        parameters: [
            new OA\Parameter(name: 'page', in: 'query', required: false, schema: new OA\Schema(type: 'integer', default: 1)),
            new OA\Parameter(name: 'per_page', in: 'query', required: false, schema: new OA\Schema(type: 'integer', default: 15)),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Paginated list of dog breeds',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'data', type: 'array', items: new OA\Items(ref: '#/components/schemas/DogResource')),
                        new OA\Property(property: 'links', type: 'object'),
                        new OA\Property(property: 'meta', type: 'object'),
                    ]
                )
            ),
        ]
    )]
    public function index(Request $request): AnonymousResourceCollection
    {
        $perPage = $request->integer('per_page', 20);

        return DogResource::collection($this->service->paginate($perPage));
    }
}
