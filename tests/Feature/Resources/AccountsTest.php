<?php

use Dyrynda\Annature\Annature;
use Dyrynda\Annature\Data\Account;
use Dyrynda\Annature\Enum\Role;
use Dyrynda\Annature\Requests\Accounts\ListAccountsRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

beforeEach(function () {
    $this->resource = (new Annature('ghi789', 'jkl012'))->accounts();
});

it('can load a list of accounts', function () {
    MockClient::global([
        ListAccountsRequest::class => MockResponse::fixture('responses/accounts/list'),
    ]);

    $accounts = $this->resource->list();

    expect($accounts)
        ->toContainOnlyInstancesOf(Account::class)
        ->and($accounts[0])
        ->id->toBe('abc123')
        ->name->toBe('Michael Dyrynda')
        ->email->toBe('michael@annature.test')
        ->number->toBe('0400000000')
        ->timezone->toBe('+10:30')
        ->role->toBe(Role::Administrator)
        ->active->toBeTrue()
        ->groupId->toBeNull()
        ->organisationId->toBe('def456')
        ->created->toEqual(new DateTimeImmutable('2024-03-15T22:21:30.000Z'))
        ->verified->toEqual(new DateTimeImmutable('2024-03-15T22:21:57.000Z'));
});
