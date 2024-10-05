<?php

namespace App\Helpers;

use App\Dto\Query\FilterCollectionDto;
use Illuminate\Database\Eloquent\Builder;

class RepositoryHelper
{
    public function applyFilters(Builder $query, FilterCollectionDto $filterCollection): void
    {
        foreach ($filterCollection->items as $filter) {
            $query->havingRaw(
                match (strtolower($filter->operator)) {
                    'in' => "lower($filter->column) in (" . implode(', ', json_decode($filter->search)) . ")",
                    'like' => "lower($filter->column) like '%" . strtolower($filter->search) . "%'",
                    default => "lower($filter->column) $filter->operator '" . strtolower($filter->search) . "'",
                }
            );
        }
    }
}
