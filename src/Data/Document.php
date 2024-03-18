<?php

declare(strict_types=1);

namespace Dyrynda\Annature\Data;

use DateTimeImmutable;

final readonly class Document extends Data
{
    public function __construct(
        public string $id,
        public string $name,
        public int $pages,
        public string $original,
        public ?string $master,
        public DateTimeImmutable $created,
    ) {
    }

    public static function fromArray(array $properties): static
    {
        return new static(...array_merge($properties, [
            'created' => DateTimeImmutable::createFromFormat('Y-m-d\TH:i:s.v\Z', $properties['created']),
        ]));
    }
}
