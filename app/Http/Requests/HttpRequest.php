<?php

namespace App\Http\Requests;

use App\Dto\Query\ExclusionCollectionDto;
use App\Dto\Query\FilterCollectionDto;
use App\Dto\Query\SortDto;
use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

#[OA\Schema]
class HttpRequest extends FormRequest
{
    #[OA\Property]
    public ?FilterCollectionDto $filters = null;

    #[OA\Property]
    public ?ExclusionCollectionDto $exclusions = null;

    #[OA\Property]
    public ?SortDto $sort = null;

    #[OA\Property]
    public ?int $page = null;

    #[OA\Property]
    public ?int $limit = null;

    #[OA\Property]
    public ?int $perPage = 20; // TODO

    protected function prepareForValidation()
    {
        if (!empty($filters = $this->get('filters'))) {
            $this->filters = FilterCollectionDto::from($filters);
        }

        if (!empty($exclusions = $this->get('exclusions'))) {
            $this->exclusions = ExclusionCollectionDto::from($exclusions);
        }

        if (!empty($sort = $this->get('sort'))) {
            $this->sort = SortDto::from($sort);
        }

        $this->page = $this->get('page');
        $this->limit = $this->get('limit');
        $this->perPage = $this->get('perPage');
    }
}
