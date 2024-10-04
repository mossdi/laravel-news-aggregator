<?php

namespace App\Dto\NewsAPI;

use Illuminate\Contracts\Support\Arrayable;

class EverythingRequestParameters implements Arrayable
{
    public ?string $q;
    public ?string $from;

    public function __construct(string $q = null, string $from = null)
    {
        $this->q = $q;
        $this->from = $from;
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        return get_object_vars($this);
    }
}
