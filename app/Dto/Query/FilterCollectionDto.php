<?php

namespace App\Dto\Query;

use App\Dto\BaseDto;
use OpenApi\Attributes as OA;

#[OA\Schema]
class FilterCollectionDto extends BaseDto
{
    /**
     * @var array<FilterDto>|null
     */
    #[OA\Property(
        items: new OA\Items(ref: '#/components/schemas/FilterDto')
    )]
    public ?array $items;

    public function __construct(?array $items)
    {
        $this->items = $items;
    }
}
