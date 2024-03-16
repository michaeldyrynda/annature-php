<?php

declare(strict_types=1);

namespace Dyrynda\Annature\Resources;

use DateTimeImmutable;
use Dyrynda\Annature\Data\Account;
use Dyrynda\Annature\Enum\Role;
use Dyrynda\Annature\Requests\Accounts\ListAccountsRequest;
use Illuminate\Support\Collection;

class Accounts extends Resource
{
    public function list(): Collection
    {
        $response = $this->connector->send(
            new ListAccountsRequest
        );

        return collect($response->json())->map(function (array $account) {
            return new Account(
                id: $account['id'],
                name: $account['name'],
                email: $account['email'],
                number: $account['number'],
                timezone: $account['timezone'],
                role: Role::from($account['role']),
                active: $account['active'],
                groupId: $account['group_id'],
                organisationId: $account['organisation_id'],
                created: DateTimeImmutable::createFromFormat('Y-m-d\TH:i:s.v\Z', $account['created']),
                verified: DateTimeImmutable::createFromFormat('Y-m-d\TH:i:s.v\Z', $account['verified']),
            );
        });
    }
}
