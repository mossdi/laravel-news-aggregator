<?php

use App\Jobs\NewsApiJob;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Schedule;

Schedule::job(App::make(NewsApiJob::class))->daily();
