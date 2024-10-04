<?php

namespace App\Http\Controllers;

use App\Http\Requests\HttpRequest;
use App\Http\Resources\UserCollection;
use App\Repositories\UserRepository;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

class UserController extends Controller
{
    public function __construct(private readonly UserRepository $repository)
    {
    }

    #[OA\Get(
        path: '/api/v1/users',
        operationId: 'getUsers',
    )]
    #[OA\RequestBody(
        required: false,
        content: [new OA\JsonContent(ref: '#/components/schemas/HttpRequest')]
    )]
    #[OA\Response(
        response: 200,
        description: 'getUsersResponse',
        content: new OA\JsonContent(ref: '#/components/schemas/UserCollection')
    )]
    public function index(HttpRequest $request): JsonResource
    {
        return UserCollection::make(
            $this->repository->all(
                $request->get('filters', []),
                $request->get('exclusions', []),
                $request->get('sort', []),
                $request->get('per_page'),
            )
        );
    }
}
