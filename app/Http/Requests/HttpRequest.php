<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

#[OA\Schema(
    properties: [
        new OA\Property(property: 'page', type: 'integer'),
        new OA\Property(property: 'limit', type: 'integer'),
        new OA\Property(property: 'sort', ref: '#/components/schemas/SortDto'),
        new OA\Property(property: 'filters', type: 'array', items: new OA\Items(ref: '#/components/schemas/FilterDto')),
    ]
)]
class HttpRequest extends FormRequest
{
    //
}
