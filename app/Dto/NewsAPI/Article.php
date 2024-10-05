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
    public string $source = 'NewsAPI';
    public Carbon $published_at;
}
