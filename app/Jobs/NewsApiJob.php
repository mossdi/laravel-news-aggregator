<?php

namespace App\Jobs;

use App\Dto\NewsAPI\EverythingRequestParameters;
use App\Helpers\ArticleHelper;
use App\Interfaces\INewsApiService;
use App\Models\Article;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Http\Client\ConnectionException;

class NewsApiJob implements ShouldQueue
{
    use Queueable;

    private string $q = 'bitcoin';
    private EverythingRequestParameters $requestParameters;

    public function __construct(
        private readonly INewsApiService $newsApiService,
        private readonly ArticleHelper $articleHelper
    )
    {
        $this->requestParameters = EverythingRequestParameters::from([
            'q' => $this->q,
            'from' => $this->articleHelper->getMaxPublishedAt()
        ]);
    }

    /**
     * Execute the job.
     * @throws ConnectionException
     */
    public function handle(): void
    {
        $everythingResponse = $this->newsApiService->everything($this->requestParameters);

        if ($everythingResponse->articles->isNotEmpty()) {
            Article::query()->insert($everythingResponse->articles->toArray());
        }
    }
}
