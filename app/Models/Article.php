<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $author
 * @property string $title
 * @property string $description
 * @property string|null $url
 * @property string $content
 * @property string $source
 * @property string $published_at
 */
class Article extends Model
{
    protected $fillable = [
        'author',
        'title',
        'description',
        'url',
        'content',
        'source',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime:Y-m-d H:i:s'
    ];
}
