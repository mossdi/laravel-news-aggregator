<?php

namespace App\Dto\Query;

use OpenApi\Attributes as OA;

#[OA\Schema]
class FilterDto
{
    #[OA\Property]
    public string $column;

    #[OA\Property]
    public string $search;

    #[OA\Property(
        default: 'like',
        enum: [
            'like',
            '=',
            '>',
            '<',
            '>=',
            '<=',
            'in',
        ]
    )]
    public string $operator = 'like';
}
