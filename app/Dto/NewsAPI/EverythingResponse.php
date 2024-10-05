<?php

namespace App\Dto\NewsAPI;

use App\Dto\BaseDto;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class EverythingResponse extends BaseDto
{
    public string $status;
    public int $totalResults;

    /**
     * @var Collection<Article>
     */
    public Collection $articles;

    /**
     * @throws UnknownProperties
     */
    public static function fromResponse(Response $response): static
    {
        $data = json_decode($response->getBody()->getContents());

        $articles = new Collection();

        if (!empty($data->articles) && is_array($data->articles)) {
            foreach ($data->articles as $article) {
                if (empty($article->author)) continue; // TODO

                $articles->add(
                    Article::fromArray([
                        'author' => $article->author,
                        'title' => $article->title,
                        'description' => $article->description,
                        'url' => $article->url,
                        'content' => $article->content,
                        'published_at' => Carbon::parse($article->publishedAt),
                    ])
                );
            }
        }

        return new static([
            'status' => $data->status ?? 404, // TODO
            'totalResults' => $articles->count(),
            'articles' => $articles,
        ]);
    }
}
