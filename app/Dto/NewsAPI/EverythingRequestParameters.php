<?php

namespace App\Dto\NewsAPI;

use App\Dto\BaseDto;

class EverythingRequestParameters extends BaseDto
{
    public ?string $q;
    public ?string $from;

    public function __construct(?string $q, ?string $from)
    {
        $this->q = $q;
        $this->from = $from;
    }
}
