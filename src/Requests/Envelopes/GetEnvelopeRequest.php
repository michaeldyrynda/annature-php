<?php

declare(strict_types=1);

namespace Dyrynda\Annature\Requests\Envelopes;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetEnvelopeRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected string $id,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return "/v1/envelopes/{$this->id}";
    }
}
