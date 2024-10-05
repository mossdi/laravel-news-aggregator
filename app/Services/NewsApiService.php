<?php

namespace App\Services;

use App\Dto\NewsAPI\EverythingRequestParameters;
use App\Dto\NewsAPI\EverythingResponse;
use App\Interfaces\INewsApiService;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class NewsApiService implements INewsApiService
{
    /**
     * @throws ConnectionException
     * @throws UnknownProperties
     */
    public function everything(EverythingRequestParameters $parameters): EverythingResponse
    {
        $queryParameters = array_filter($parameters->toArray());

        $response = Http::withHeaders(['Authorization' => config('news-api.api-key')])
            ->withQueryParameters($queryParameters)
            ->get(config('news-api.api-base-url') . 'everything');

        return EverythingResponse::fromResponse($response);
    }
}
