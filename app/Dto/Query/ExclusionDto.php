<?php

namespace App\Dto\Query;

use App\Dto\BaseDto;
use App\Enums\ConditionOperator;
use OpenApi\Attributes as OA;

#[OA\Schema]
class ExclusionDto extends BaseDto
{
    #[OA\Property]
    public string $column;

    #[OA\Property]
    public string $search;

    #[OA\Property(
        ref: '#/components/schemas/ConditionOperator',
        default: ConditionOperator::LIKE->value
    )]
    public string $operator;

    public function __construct(string $column, string $search, string $operator)
    {
        $this->column = $column;
        $this->search = $search;
        $this->operator = $operator;
    }
}
