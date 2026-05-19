<?php

namespace App\Dogs\Swagger;

use OpenApi\Attributes as OA;

#[OA\Info(version : '1.0.0', description : 'API for fetching dog breeds', title : 'Dogs API')]
#[OA\Server(url: '/api', description: 'API server')]
class SwaggerInfo {}
