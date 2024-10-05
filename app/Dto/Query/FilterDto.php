<?php

namespace App\Dto\Query;

use App\Dto\BaseDto;
use OpenApi\Attributes as OA;

#[OA\Schema]
class FilterDto extends BaseDto
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
