<?php

namespace App\Interfaces;

use App\Dto\NewsAPI\EverythingRequestParameters;
use App\Dto\NewsAPI\EverythingResponse;
use Illuminate\Http\Client\ConnectionException;

interface INewsApiService
{
    /**
     * @throws ConnectionException
     */
    public function everything(EverythingRequestParameters $parameters): EverythingResponse;
}
