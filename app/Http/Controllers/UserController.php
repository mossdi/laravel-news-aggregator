<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserCollection;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserController extends Controller
{
    public function __construct(private readonly UserRepository $repository)
    {
    }

    public function index(Request $request): JsonResource
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
