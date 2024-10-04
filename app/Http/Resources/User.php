<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

#[OA\Schema(
    properties: [
        new OA\Property(property: 'id', type: 'string'),
        new OA\Property(property: 'name', type: 'string'),
        new OA\Property(property: 'email', type: 'string'),
    ]
)]
class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
