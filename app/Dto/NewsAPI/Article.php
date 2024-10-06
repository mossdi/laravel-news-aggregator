<?php

namespace App\Dto\NewsAPI;

use App\Dto\BaseDto;
use Illuminate\Support\Carbon;

class Article extends BaseDto
{
    public string $author;
    public string $title;
    public string $description;
    public string $url;
    public string $content;
    public string $source;
    public Carbon $published_at;

    public function __construct(string $author, string $title, string $description, string $url, string $content, string $source, Carbon $published_at)
    {
        $this->author = $author;
        $this->title = $title;
        $this->description = $description;
        $this->url = $url;
        $this->content = $content;
        $this->source = $source;
        $this->published_at = $published_at;
    }
}
