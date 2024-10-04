<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

#[OA\Schema(
    properties: [
        new OA\Property(
            property: 'data',
            type: 'array',
            items: new OA\Items(ref: '#/components/schemas/User')
        ),
    ]
)]
class UserCollection extends BaseResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
