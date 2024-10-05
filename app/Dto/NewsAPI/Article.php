<?php

namespace App\Dto\NewsAPI;

use App\Dto\BaseDto;
use Illuminate\Support\Carbon;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class Article extends BaseDto
{
    private string $author;
    private string $title;
    private string $description;
    private string $url;
    private string $content;
    private string $source;
    private Carbon $published_at;

    /**
     * @throws UnknownProperties
     */
    public function __construct(...$args)
    {
        parent::__construct($args);

        $this->source = 'NewsAPI';
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getSource(): string
    {
        return $this->source;
    }

    public function getPublishedAt(): Carbon
    {
        return $this->published_at;
    }
}
