<?php

declare(strict_types=1);

namespace Dyrynda\Annature\Data;

use Dyrynda\Annature\Enum\FieldType;
use Dyrynda\Annature\Enum\FontType;
use Illuminate\Support\Collection;

final readonly class CreateFieldData extends Data
{
    public FontType $fontType;

    /** @var \Illuminate\Support\Collection<\Dyrynda\Annature\Data\FieldOption> */
    public Collection $options;

    public function __construct(
        public FieldType $type,
        public ?string $id,
        public ?int $page,
        public ?string $anchor,
        public ?int $xOffset,
        public ?int $yOffset,
        public ?int $xCoordinate,
        public ?int $yCoordinate,
        public bool $required,
        public bool $readOnly,
        public bool $collaborative,
        public ?string $value,
        public bool $checked,
        public ?int $height,
        public ?int $width,
        public ?int $fontSize,
        public ?string $dateFormat,
        ?Collection $options,
        ?FontType $fontType,
    ) {
        $this->fontType = $fontType ?: FontType::Courier;
        $this->options = $options?->isNotEmpty() ? $options : collect();
    }

    public function toArray(): array
    {
        return array_filter([
            'id' => $this->id,
            'type' => $this->type->value,
            'page' => $this->page,
            'anchor' => $this->anchor,
            'x_offset' => $this->xOffset,
            'y_offset' => $this->yOffset,
            'x_coordinate' => $this->xCoordinate,
            'y_coordinate' => $this->yCoordinate,
            'required' => $this->required,
            'read_only' => $this->readOnly,
            'collaborative' => $this->collaborative,
            'value' => $this->value,
            'checked' => $this->checked,
            'height' => $this->height,
            'width' => $this->width,
            'options' => $this->options->toArray(),
            'font_size' => $this->fontSize,
            'font_type' => $this->fontType->value,
            'date_format' => $this->dateFormat,
        ], fn ($value) => ! is_null($value) && ! empty($value));
    }
}
