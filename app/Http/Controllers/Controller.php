<?php

namespace App\Http\Controllers;

use OpenApi\Attributes as OA;

#[OA\OpenApi(openapi: '3.0.0')]
#[OA\Info(version: '1.0.0', title: 'news-aggregator')]
#[OA\Server(url: 'http://127.0.0.1:8080/')]
abstract class Controller
{
    //
}
