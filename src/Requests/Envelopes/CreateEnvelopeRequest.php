<?php

declare(strict_types=1);

namespace Dyrynda\Annature\Requests\Envelopes;

use Dyrynda\Annature\Data\CreateEnvelopeData;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class CreateEnvelopeRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        protected CreateEnvelopeData $envelope,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/v1/envelopes';
    }

    protected function defaultBody(): array
    {
        return $this->envelope->toArray();
    }
}
