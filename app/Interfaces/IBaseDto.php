<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

interface IBaseDto
{
    /**
     * @throws UnknownProperties
     */
    public static function fromArray(array $data): static;

    /**
     * @throws UnknownProperties
     */
    public static function fromModel(Model $model): static;
}
