<?php

namespace App\Dto\NewsAPI;

use App\Dto\BaseDto;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class EverythingResponse extends BaseDto
{
    public string $status;
    public int $totalResults;

    /**
     * @var Collection<Article>
     */
    public Collection $articles;

    public function __construct(string $status, int $totalResults, Collection $articles)
    {
        $this->status = $status;
        $this->totalResults = $totalResults;
        $this->articles = $articles;
    }

    public static function fromResponse(Response $response): static
    {
        $data = json_decode($response->getBody()->getContents());

        $articles = new Collection();

        if (!empty($data->articles) && is_array($data->articles)) {
            foreach ($data->articles as $article) {
                if (empty($article->author)) continue; // TODO

                $articles->add(
                    new Article(
                        author: $article->author,
                        title: $article->title,
                        description: $article->description,
                        url: $article->url,
                        content: $article->content,
                        source: 'NewsAPI',
                        published_at: Carbon::parse($article->publishedAt),
                    )
                );
            }
        }

        return new static(
            status: $data->status ?? 404, // TODO
            totalResults: $articles->count(),
            articles: $articles,
        );
    }
}
