<?php

namespace App\Dto\NewsAPI;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class EverythingResponse implements Arrayable
{
    private string $status;
    private int $totalResults;

    /**
     * @var Collection<Article>
     */
    private Collection $articles;

    public function __construct(string $status, int $totalResults, Collection $articles)
    {
        $this->status = $status;
        $this->totalResults = $totalResults;
        $this->articles = $articles;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getTotalResults(): int
    {
        return $this->totalResults;
    }

    public function getArticles(): Collection
    {
        return $this->articles;
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
                        published_at: Carbon::parse($article->publishedAt),
                    )
                );
            }
        }

        return new static(
            status: $data->status ?? 404, // TODO
            totalResults: $articles->count(),
            articles: $articles
        );
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        return get_object_vars($this);
    }
}
