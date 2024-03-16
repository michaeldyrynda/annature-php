<?php

declare(strict_types=1);

namespace Dyrynda\Annature\Data;

use DateTimeImmutable;
use Dyrynda\Annature\Enum\FieldType;
use Dyrynda\Annature\Enum\FontType;

final readonly class Field extends Data
{
    public function __construct(
        public ?string $id,
        public FieldType $type,
        public ?int $page,
        public ?string $anchor,
        public ?int $xCoordinate,
        public ?int $yCoordinate,
        public bool $required,
        public bool $readOnly,
        public bool $collaborative,
        public ?string $value,
        public bool $checked,
        public ?int $height,
        public ?int $width,
        /** @var \Dyrynda\Annature\Data\FieldOption[] */
        public ?array $options,
        public ?int $fontSize,
        public ?FontType $fontType,
        public ?string $dateFormat,
        public ?DateTimeImmutable $created,
    ) {
    }

    public static function fromArray(array $properties): static
    {
        return new self(
            id: $properties['id'] ?? null,
            type: FieldType::from($properties['type']),
            page: $properties['page'] ?? null,
            anchor: $properties['anchor'] ?? null,
            xCoordinate: $properties['x_coordinate'] ?? null,
            yCoordinate: $properties['y_coordinate'] ?? null,
            required: $properties['required'] ?? false,
            readOnly: $properties['readonly'] ?? false,
            collaborative: $properties['collaborative'] ?? false,
            value: $properties['value'] ?? null,
            checked: $properties['checked'] ?? false,
            height: $properties['height'] ?? null,
            width: $properties['width'] ?? null,
            options: collect($properties['options'] ?? [])->map(fn (array $option) => FieldOption::fromArray($option))->all(),
            fontSize: $properties['fontSize'] ?? 12,
            fontType: FontType::tryFrom($properties['fontType'] ?? '') ?: FontType::Courier,
            dateFormat: $properties['date_format'] ?? 'DD/MM/YYYY',
            created: isset($properties['created'])
                ? DateTimeImmutable::createFromFormat('Y-m-d\TH:i:s.v\Z', $properties['created'])
                : null,
        );
    }
}
