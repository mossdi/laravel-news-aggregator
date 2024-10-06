<?php

namespace App\Dto\Query;

use App\Dto\BaseDto;
use OpenApi\Attributes as OA;

#[OA\Schema]
class ExclusionCollectionDto extends BaseDto
{
    /**
     * @var array<ExclusionDto>|null
     */
    #[OA\Property(
        items: new OA\Items(ref: '#/components/schemas/ExclusionDto')
    )]
    public ?array $items;

    public function __construct(?array $items)
    {
        $this->items = $items;
    }
}
