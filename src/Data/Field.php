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

    public static function fromArray(array $field): self
    {
        return new self(
            id: $field['id'] ?? null,
            type: FieldType::from($field['type']),
            page: $field['page'] ?? null,
            anchor: $field['anchor'] ?? null,
            xCoordinate: $field['x_coordinate'] ?? null,
            yCoordinate: $field['y_coordinate'] ?? null,
            required: $field['required'] ?? false,
            readOnly: $field['readonly'] ?? false,
            collaborative: $field['collaborative'] ?? false,
            value: $field['value'] ?? null,
            checked: $field['checked'] ?? false,
            height: $field['height'] ?? null,
            width: $field['width'] ?? null,
            options: collect($field['options'] ?? [])->map(fn (array $option) => FieldOption::fromArray($option))->all(),
            fontSize: $field['fontSize'] ?? 12,
            fontType: FontType::tryFrom($field['fontType'] ?? '') ?: FontType::Courier,
            dateFormat: $field['date_format'] ?? 'DD/MM/YYYY',
            created: isset($field['created'])
                ? DateTimeImmutable::createFromFormat('Y-m-d\TH:i:s.v\Z', $field['created'])
                : null,
        );
    }
}
