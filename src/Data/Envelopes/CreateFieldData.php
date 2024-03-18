<?php

declare(strict_types=1);

namespace Dyrynda\Annature\Data\Envelopes;

use Dyrynda\Annature\Data\Data;
use Dyrynda\Annature\Enum\FieldType;
use Dyrynda\Annature\Enum\FontType;
use Illuminate\Support\Collection;

final readonly class CreateFieldData extends Data
{
    public FontType $fontType;

    /** @var \Illuminate\Support\Collection<array-key, \Dyrynda\Annature\Data\FieldOption> */
    public Collection $options;

    /**
     * @param \Illuminate\Support\Collection<array-key, \Dyrynda\Annature\Data\FieldOption> $options
     */
    public function __construct(
        public FieldType $type,
        public bool $required,
        public bool $readOnly = false,
        public bool $collaborative = false,
        public bool $checked = false,
        public ?string $id = null,
        public ?int $page = null,
        public ?string $anchor = null,
        public ?int $xOffset = null,
        public ?int $yOffset = null,
        public ?int $xCoordinate = null,
        public ?int $yCoordinate = null,
        public ?string $value = null,
        public ?int $height = null,
        public ?int $width = null,
        public ?int $fontSize = null,
        public ?string $dateFormat = null,
        ?Collection $options = null,
        ?FontType $fontType = null,
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
