<?php

namespace App\Interfaces;

use App\Dto\Query\ExclusionCollectionDto;
use App\Dto\Query\FilterCollectionDto;
use App\Dto\Query\SortDto;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface IBaseRepository
{
    public function all(
        FilterCollectionDto $filters = null,
        ExclusionCollectionDto $exclusions = null,
        SortDto $sort = null,
        int $perPage = null
    ): LengthAwarePaginator|Collection;
}
