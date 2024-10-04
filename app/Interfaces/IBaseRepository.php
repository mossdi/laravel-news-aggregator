<?php

namespace App\Interfaces;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface IBaseRepository
{
    public function all(array $filters = [], array $exclusions = [], array $sort = [], int $perPage = null): LengthAwarePaginator|Collection;
}
