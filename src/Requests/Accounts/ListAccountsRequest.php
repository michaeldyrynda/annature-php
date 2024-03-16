<?php

declare(strict_types=1);

namespace Dyrynda\Annature\Requests\Accounts;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class ListAccountsRequest extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/v1/accounts';
    }
}
