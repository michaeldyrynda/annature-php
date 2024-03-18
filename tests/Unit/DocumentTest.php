<?php

declare(strict_types=1);

use Dyrynda\Annature\Data\Document;

it('can resolve a document from an array', function () {
    expect(Document::fromArray([
        'id' => 'fcad499b03c6fc222bc66208317a18c9',
        'name' => 'Non disclosure agreement.pdf',
        'pages' => 10,
        'original' => 'https://annature..',
        'master' => 'https://annature..',
        'created' => '2019-12-17T05:30:00.000Z',
    ]))
        ->toMatchSnapshot()
        ->toBeInstanceOf(Document::class)
        ->id->toBe('fcad499b03c6fc222bc66208317a18c9');
});
