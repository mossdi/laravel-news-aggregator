<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleCollection;
use App\Repositories\ArticleRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleController extends Controller
{
    public function __construct(private readonly ArticleRepository $repository)
    {
    }

    public function index(Request $request): JsonResource
    {
        return ArticleCollection::make(
            $this->repository->all(
                $request->get('filters', []),
                $request->get('exclusions', []),
                $request->get('sort', []),
                $request->get('per_page'),
            )
        );
    }
}
