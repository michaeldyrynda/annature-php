<?php

declare(strict_types=1);

namespace Dyrynda\Annature\Requests\Documents;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class ListDocumentsRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected string $envelopeId,
        protected int $duration = 60,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return "/v1/documents";
    }

    protected function defaultQuery(): array
    {
        return [
            'envelope_id' => $this->envelopeId,
            'endpoint_duration' => $this->duration,
        ];
    }
}
