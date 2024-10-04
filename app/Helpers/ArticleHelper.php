<?php

namespace App\Helpers;

use App\Models\Article;
use Illuminate\Support\Carbon;

class ArticleHelper
{
    public function getMaxPublishedAt(): ?Carbon
    {
        $from = Article::query()->max('published_at');
        return Carbon::make($from)?->addSecond(); // TODO
    }
}
