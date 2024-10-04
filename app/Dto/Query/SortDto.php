<?php

namespace App\Dto\Query;

use OpenApi\Attributes as OA;

#[OA\Schema]
class SortDto
{
    #[OA\Property]
    public string $column;

    #[OA\Property(ref: '#/components/schemas/SortDirection')]
    public string $direction;
}