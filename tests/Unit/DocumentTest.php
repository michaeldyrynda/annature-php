<?php

declare(strict_types=1);

use Dyrynda\Annature\Data\Document;

beforeEach(function () {
    $this->array = [
        'id' => 'fcad499b03c6fc222bc66208317a18c9',
        'name' => 'Non disclosure agreement.pdf',
        'base' => 'iVBORw0KGgoAAAANSUhE..',
    ];
});

it('can resolve a document from an array', function () {
    expect(Document::fromArray($this->array))
        ->toMatchSnapshot()
        ->toBeInstanceOf(Document::class)
        ->id->toBe('fcad499b03c6fc222bc66208317a18c9')
        ->name->toBe('Non disclosure agreement.pdf')
        ->base->toBe('iVBORw0KGgoAAAANSUhE..');
});
