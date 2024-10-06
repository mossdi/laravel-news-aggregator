<?php

namespace App\Dto\Query;

use App\Dto\BaseDto;
use OpenApi\Attributes as OA;

#[OA\Schema]
class SortDto extends BaseDto
{
    #[OA\Property]
    public string $column;

    #[OA\Property(ref: '#/components/schemas/SortDirection')]
    public string $direction;

    public function __construct(string $column, string $direction)
    {
        $this->column = $column;
        $this->direction = $direction;
    }
}
