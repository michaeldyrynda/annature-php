<?php

declare(strict_types=1);

namespace Dyrynda\Annature\Data;

final readonly class FieldOption extends Data
{
    public function __construct(
        public string $value,
        public string $option,
    ) {
    }
}
