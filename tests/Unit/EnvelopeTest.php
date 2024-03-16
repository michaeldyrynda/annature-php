<?php

declare(strict_types=1);

use Dyrynda\Annature\Data\Envelope;
use Dyrynda\Annature\Enum\EnvelopeStatus;

beforeEach(function () {
    $this->array = [
        'id' => '7e8f68e4c6df9395cd7ff48d69d7e2c1',
        'name' => 'Non disclosure agreement',
        'message' => 'Lorem ipsum dolor sit amet.',
        'status' => 'sent',
        'shared' => false,
        'created' => '2019-12-17T05:30:00.000Z',
        'sent' => '2019-12-17T05:30:00.000Z',
        'voided' => '2019-12-17T05:30:00.000Z',
        'declined' => '2019-12-17T05:30:00.000Z',
        'completed' => '2019-12-17T05:30:00.000Z',
        'master' => 'https://annature..',
        'certificate' => 'https://annature..',
        'account_id' => 'c64ce66b70b21c03bfd5dfa0ab14b730',
        'group_id' => 'a5a885caee6286a54ad7bbd4ab5400e9',
        'recipients' => [],
        'metadata' => [],
    ];
});

it('can resolve an account from an array', function () {
    expect(Envelope::fromArray($this->array))
        ->toMatchSnapshot()
        ->toBeInstanceOf(Envelope::class)
        ->id->toBe('7e8f68e4c6df9395cd7ff48d69d7e2c1')
        ->name->toBe('Non disclosure agreement')
        ->message->toBe('Lorem ipsum dolor sit amet.')
        ->status->toBe(EnvelopeStatus::Sent)
        ->created->toEqual(DateTimeImmutable::createFromFormat('Y-m-d\TH:i:s\Z', '2019-12-17T05:30:00Z'))
        ->sent->toEqual(DateTimeImmutable::createFromFormat('Y-m-d\TH:i:s\Z', '2019-12-17T05:30:00Z'))
        ->voided->toEqual(DateTimeImmutable::createFromFormat('Y-m-d\TH:i:s\Z', '2019-12-17T05:30:00Z'))
        ->declined->toEqual(DateTimeImmutable::createFromFormat('Y-m-d\TH:i:s\Z', '2019-12-17T05:30:00Z'))
        ->completed->toEqual(DateTimeImmutable::createFromFormat('Y-m-d\TH:i:s\Z', '2019-12-17T05:30:00Z'))
        ->master->toBe('https://annature..')
        ->certificate->toBe('https://annature..')
        ->accountId->toBe('c64ce66b70b21c03bfd5dfa0ab14b730')
        ->groupId->toBe('a5a885caee6286a54ad7bbd4ab5400e9')
        ->recipients->toBeEmpty()
        ->metadata->toBeEmpty();
});
