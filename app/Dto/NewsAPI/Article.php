<?php

namespace App\Dto\NewsAPI;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Carbon;

class Article implements Arrayable
{
    private string $author;
    private string $title;
    private string $description;
    private string $url;
    private string $content;
    private string $source;
    private Carbon $published_at;

    /**
     * @param string $author
     * @param string $title
     * @param string $description
     * @param string $url
     * @param string $content
     * @param Carbon $published_at
     */
    public function __construct(string $author, string $title, string $description, string $url, string $content, Carbon $published_at)
    {
        $this->author = $author;
        $this->title = $title;
        $this->description = $description;
        $this->url = $url;
        $this->content = $content;
        $this->published_at = $published_at;

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

    public function getPublishedAt(): string
    {
        return $this->published_at;
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        return get_object_vars($this);
    }
}
