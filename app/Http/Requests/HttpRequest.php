<?php

namespace App\Http\Requests;

use App\Dto\Query\ExclusionCollectionDto;
use App\Dto\Query\FilterCollectionDto;
use App\Dto\Query\SortDto;
use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

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

    /**
     * @throws UnknownProperties
     */
    protected function prepareForValidation()
    {
        if (!empty($filters = $this->get('filters'))) {
            $this->filters = FilterCollectionDto::fromArray($filters);
        }

        if (!empty($exclusions = $this->get('exclusions'))) {
            $this->exclusions = ExclusionCollectionDto::fromArray($exclusions);
        }

        if (!empty($sort = $this->get('sort'))) {
            $this->sort = SortDto::fromArray($sort);
        }

        $this->page = $this->get('page');
        $this->limit = $this->get('limit');
        $this->perPage = $this->get('perPage');
    }
}
