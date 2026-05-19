<?php

namespace App\Dogs\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'DogResource',
    properties: [
        new OA\Property(property: 'id', type: 'integer', example: 1),
        new OA\Property(property: 'name', type: 'string', example: 'Labrador Retriever'),
        new OA\Property(property : 'temperament', type : 'string', example : 'Kind, Outgoing, Agile', nullable : true),
        new OA\Property(
            property : 'weight',
            properties : [
                new OA\Property(property : 'metric', type : 'string', example : '25 - 36', nullable : true),
                new OA\Property(property : 'imperial', type : 'string', example : '55 - 80', nullable : true),
            ],
            type : 'object'
        ),
        new OA\Property(property : 'life_span', type : 'string', example : '10 - 12 years', nullable : true),
    ]
)]
class DogResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'temperament' => $this->temperament,
            'weight' => [
                'metric' => $this->weight_metric,
                'imperial' => $this->weight_imperial,
            ],
            'life_span' => $this->life_span,
        ];
    }
}
