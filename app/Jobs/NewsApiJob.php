<?php

namespace App\Jobs;

use App\Dto\NewsAPI\EverythingRequestParameters;
use App\Helpers\ArticleHelper;
use App\Interfaces\INewsApiService;
use App\Models\Article;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Http\Client\ConnectionException;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class NewsApiJob implements ShouldQueue
{
    use Queueable;

    private string $q = 'bitcoin';
    private EverythingRequestParameters $requestParameters;

    /**
     * Create a new job instance.
     * @throws UnknownProperties
     */
    public function __construct(
        private readonly INewsApiService $newsApiService,
        private readonly ArticleHelper $articleHelper
    )
    {
        $this->requestParameters = EverythingRequestParameters::fromArray([
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
        $articles = $this->newsApiService->everything($this->requestParameters);

        if ($articles->getArticles()->isNotEmpty()) {
            Article::query()->insert($articles->getArticles()->toArray());
        }
    }
}
