<?php

namespace App\Enums;

use OpenApi\Attributes as OA;

#[OA\Schema]
enum SortDirection: string
{
    #[OA\Property]
    case DESC = 'desc';

    #[OA\Property]
    case ASC = 'asc';
}
