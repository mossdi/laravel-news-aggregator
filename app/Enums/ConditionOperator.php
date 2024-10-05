<?php

namespace App\Enums;

use OpenApi\Attributes as OA;

#[OA\Schema]
enum ConditionOperator: string
{
    #[OA\Property]
    case LIKE = 'like';

    #[OA\Property]
    case EQUAL = '=';

    #[OA\Property]
    case MORE = '>';

    #[OA\Property]
    case LESS = '<';

    #[OA\Property]
    case MORE_OR_EQUAL = '>=';

    #[OA\Property]
    case LESS_OR_EQUAL = '<=';

    #[OA\Property]
    case IN = 'in';
}
