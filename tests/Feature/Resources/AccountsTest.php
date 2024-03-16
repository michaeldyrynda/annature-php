<?php

use Dyrynda\Annature\Annature;
use Dyrynda\Annature\Data\Account;
use Dyrynda\Annature\Requests\Accounts\GetAccountRequest;
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

    expect($this->resource->list())
        ->toMatchSnapshot()
        ->toContainOnlyInstancesOf(Account::class);
});

it('can load a single account', function () {
    MockClient::global([
        GetAccountRequest::class => MockResponse::fixture('responses/accounts/get'),
    ]);

    $account = $this->resource->get('abc123');

    expect($account)
        ->toMatchSnapshot()
        ->toBeInstanceOf(Account::class)
        ->id->toBe('abc123');
});
