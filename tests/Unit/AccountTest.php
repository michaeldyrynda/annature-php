<?php

declare(strict_types=1);

use Dyrynda\Annature\Data\Account;
use Dyrynda\Annature\Enum\Role;

it('can resolve an account from an array', function () {
    expect(Account::fromArray([
        'id' => 'abc123',
        'name' => 'Michael Dyrynda',
        'email' => 'michael@annature.test',
        'number' => '0400000000',
        'timezone' => '+10:30',
        'role' => 'administrator',
        'active' => true,
        'group_id' => null,
        'organisation_id' => 'def456',
        'created' => '2024-03-15T22:21:30.000Z',
        'verified' => '2024-03-15T22:21:57.000Z',
    ]))
        ->toMatchSnapshot()
        ->toBeInstanceOf(Account::class)
        ->id->toBe('abc123')
        ->name->toBe('Michael Dyrynda')
        ->number->toBe('0400000000')
        ->timezone->toBe('+10:30')
        ->role->toBe(Role::Administrator)
        ->active->toBeTrue()
        ->groupId->toBeNull()
        ->organisationId->toBe('def456')
        ->created->toEqual(DateTimeImmutable::createFromFormat('Y-m-d\TH:i:s.v\Z', '2024-03-15T22:21:30.000Z'))
        ->verified->toEqual(DateTimeImmutable::createFromFormat('Y-m-d\TH:i:s.v\Z', '2024-03-15T22:21:57.000Z'));
});
