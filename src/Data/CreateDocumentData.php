<?php

declare(strict_types=1);

namespace Dyrynda\Annature\Data;

final readonly class CreateDocumentData extends Data
{
    public function __construct(
        public string $base,
        public ?string $id = null,
        public ?string $name = null,
    ) {
    }

    public function toArray(): array
    {
        return array_filter([
            'base' => $this->base,
            'id' => $this->id,
            'name' => $this->name,
        ], fn ($value) => ! is_null($value));
    }
}
