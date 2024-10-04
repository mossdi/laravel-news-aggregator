<?php

namespace Database\Seeders;

use App\Jobs\NewsApiJob;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class ArticleSeeder extends Seeder
{
    public function __construct()
    {
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        dispatch(App::make(NewsApiJob::class));
    }
}
