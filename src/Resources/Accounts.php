<?php

declare(strict_types=1);

namespace Dyrynda\Annature\Resources;

use Dyrynda\Annature\Data\Account;
use Dyrynda\Annature\Requests\Accounts\GetAccountRequest;
use Dyrynda\Annature\Requests\Accounts\ListAccountsRequest;
use Illuminate\Support\Collection;

class Accounts extends Resource
{
    public function list(): Collection
    {
        $response = $this->connector->send(
            new ListAccountsRequest
        );

        return collect($response->json())->map(fn (array $account) => Account::fromArray($account));
    }

    public function get(string $id): Account
    {
        $response = $this->connector->send(
            new GetAccountRequest($id)
        );

        return Account::fromArray($response->json());
    }
}
