<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use OpenApi\Attributes as OA;

#[OA\Schema(
    properties: [
        new OA\Property(
            property: 'links',
            properties: [
                new OA\Property(property: 'first', type: 'string'),
                new OA\Property(property: 'last', type: 'string'),
                new OA\Property(property: 'prev', type: 'string'),
                new OA\Property(property: 'next', type: 'string'),
            ],
            type: 'object'
        ),
        new OA\Property(property: 'path', type: 'string'),
        new OA\Property(property: 'per_page', type: 'integer'),
        new OA\Property(property: 'to', type: 'integer'),
        new OA\Property(property: 'total', type: 'integer'),
    ]
)]
abstract class BaseResourceCollection extends ResourceCollection
{
}
