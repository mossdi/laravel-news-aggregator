<?php

namespace App\Repositories;

use App\Interfaces\IBaseRepository;
use App\Models\Article;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ArticleRepository implements IBaseRepository
{
    public function all(array $filters = [], array $exclusions = [], array $sort = [], int $perPage = null): LengthAwarePaginator|Collection
    {
        $query = Article::query();

        return $perPage
            ? $query->paginate($perPage)
            : $query->get();
    }
}
