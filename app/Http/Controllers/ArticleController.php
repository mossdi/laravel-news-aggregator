<?php

namespace App\Http\Controllers;

use App\Http\Requests\HttpRequest;
use App\Http\Resources\ArticleCollection;
use App\Repositories\ArticleRepository;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

class ArticleController extends Controller
{
    public function __construct(private readonly ArticleRepository $repository)
    {
    }

    #[OA\Get(
        path: '/api/v1/articles',
        operationId: 'getArticles',
    )]
    #[OA\RequestBody(
        required: false,
        content : [new OA\JsonContent(ref: '#/components/schemas/HttpRequest')]
    )]
    #[OA\Response(
        response: 200,
        description: 'getArticlesResponse',
        content: new OA\JsonContent(ref: '#/components/schemas/ArticleCollection')
    )]
    public function index(HttpRequest $request): JsonResource
    {
        return ArticleCollection::make(
            $this->repository->all(
                $request->get('filters', []),
                $request->get('exclusions', []),
                $request->get('sort', []),
                $request->get('per_page', 20),
            )
        );
    }
}
