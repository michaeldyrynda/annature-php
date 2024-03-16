<?php

namespace Dyrynda\Annature\Data;

use Illuminate\Contracts\Support\Arrayable;
use Stringable;

abstract readonly class Data implements Arrayable, Stringable
{
    public function toArray(): array
    {
        return get_object_vars($this);
    }

    public function __toString(): string
    {
        return json_encode($this->toArray()) ?: '';
    }
}
