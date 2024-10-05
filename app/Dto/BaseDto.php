<?php

namespace App\Dto;

use App\Interfaces\IBaseDto;
use Illuminate\Contracts\Support\Arrayable;
use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class BaseDto extends DataTransferObject implements IBaseDto, Arrayable
{
    /**
     * @throws UnknownProperties
     */
    public static function fromArray(array $data): static
    {
        return new static($data);
    }

    /**
     * @throws UnknownProperties
     */
    public static function fromModel($model): static
    {
        return new static($model->toArray());
    }
}
