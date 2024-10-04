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

    private ?string $q;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private readonly INewsApiService $newsApiService,
        private readonly ArticleHelper $articleHelper
    )
    {
        $this->q = 'bitcoin';
    }

    /**
     * Execute the job.
     * @throws ConnectionException
     */
    public function handle(): void
    {
        $articles = $this->newsApiService
            ->everything(new EverythingRequestParameters(q: $this->q, from: $this->articleHelper->getMaxPublishedAt()));

        if ($articles->getArticles()->isNotEmpty()) {
            Article::query()->insert($articles->getArticles()->toArray());
        }
    }
}
