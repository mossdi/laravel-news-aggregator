<?php

namespace App\Dto\NewsAPI;

use App\Dto\BaseDto;

class EverythingRequestParameters extends BaseDto
{
    public ?string $q;
    public ?string $from;

    public function getQ(): ?string
    {
        return $this->q;
    }

    public function getFrom(): ?string
    {
        return $this->from;
    }
}
