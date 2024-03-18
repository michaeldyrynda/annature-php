<?php

declare(strict_types=1);

use Dyrynda\Annature\Data\Field;
use Dyrynda\Annature\Enum\FieldType;
use Dyrynda\Annature\Enum\FontType;

it('can resolve a field from an array', function () {
    expect(Field::fromArray([
        'id' => '5f66f4705e35d5c49d2a7af7a896b8b4',
        'type' => 'signature',
        'page' => 1,
        'anchor' => '{{signature}}',
        'x_coordinate' => 150,
        'y_coordinate' => 400,
        'required' => true,
        'read_only' => false,
        'collaborative' => false,
        'value' => 'foo',
        'checked' => false,
        'height' => 30,
        'width' => 100,
        'options' => [],
        'font_size' => 12,
        'font_type' => 'courier',
        'date_format' => 'DD/MM/YYYY',
        'created' => '2019-12-17T05:30:00.000Z',
    ]))
        ->toMatchSnapshot()
        ->toBeInstanceOf(Field::class)
        ->id->toBe('5f66f4705e35d5c49d2a7af7a896b8b4')
        ->type->toBe(FieldType::Signature)
        ->page->toBe(1)
        ->anchor->toBe('{{signature}}')
        ->xCoordinate->toBe(150)
        ->yCoordinate->toBe(400)
        ->required->toBeTrue()
        ->readOnly->toBeFalse()
        ->collaborative->toBeFalse()
        ->value->toBe('foo')
        ->height->toBe(30)
        ->width->toBe(100)
        ->options->toBeEmpty()
        ->fontSize->tobe(12)
        ->fontType->toBe(FontType::Courier)
        ->dateFormat->toBe('DD/MM/YYYY')
        ->created->toEqual(DateTimeImmutable::createFromFormat('Y-m-d\TH:i:s.v\Z', '2019-12-17T05:30:00.000Z'));
});
