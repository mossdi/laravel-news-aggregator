<?php

namespace App\Repositories;

use App\Dto\Query\ExclusionCollectionDto;
use App\Dto\Query\FilterCollectionDto;
use App\Dto\Query\SortDto;
use App\Helpers\RepositoryHelper;
use App\Interfaces\IArticleRepository;
use App\Models\Article;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ArticleRepository implements IArticleRepository
{
    public function __construct(private readonly RepositoryHelper $helper)
    {
    }

    public function all(
        FilterCollectionDto $filters = null,
        ExclusionCollectionDto $exclusions = null,
        SortDto $sort = null,
        int $perPage = null
    ): LengthAwarePaginator|Collection
    {
        $query = Article::query()
            ->when($filters->items, fn(Builder $q) => $this->helper->applyFilters($q, $filters));

        return $perPage
            ? $query->paginate($perPage)
            : $query->get();
    }
}
