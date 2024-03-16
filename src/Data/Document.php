<?php

declare(strict_types=1);

namespace Dyrynda\Annature\Data;

final readonly class Document extends Data
{
    public function __construct(
        public string $base,
        public ?string $id = null,
        public ?string $name = null,
    ) {
    }
}
