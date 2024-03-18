<?php

declare(strict_types=1);

namespace Dyrynda\Annature\Resources;

use DateTimeImmutable;
use Dyrynda\Annature\Data\CreateEnvelopeData;
use Dyrynda\Annature\Data\Envelope;
use Dyrynda\Annature\Enum\EnvelopeStatus;
use Dyrynda\Annature\Requests\Envelopes\CreateEnvelopeRequest;
use Dyrynda\Annature\Requests\Envelopes\GetEnvelopeRequest;
use Dyrynda\Annature\Requests\Envelopes\ListEnvelopesRequest;
use Dyrynda\Annature\Requests\Envelopes\SendEnvelopeRequest;
use Illuminate\Support\Collection;

class Envelopes extends Resource
{
    public function list(
        ?string $name = null,
        ?EnvelopeStatus $status = null,
        ?string $recipient = null,
        ?DateTimeImmutable $createdBefore = null,
        ?DateTimeImmutable $createdAfter = null,
        ?DateTimeImmutable $completedBefore = null,
        ?DateTimeImmutable $completedAfter = null,
    ): Collection {
        $response = $this->connector->send(
            new ListEnvelopesRequest(
                name: $name,
                status: $status,
                recipient: $recipient,
                createdBefore: $createdBefore,
                createdAfter: $createdAfter,
                completedBefore: $completedBefore,
                completedAfter: $completedAfter
            )
        );

        return collect($response->json())->map(fn (array $envelope) => Envelope::fromArray($envelope));
    }

    public function get(string $id): Envelope
    {
        $response = $this->connector->send(
            new GetEnvelopeRequest($id)
        );

        return Envelope::fromArray($response->json());
    }

    public function create(CreateEnvelopeData $envelope): Envelope
    {
        $response = $this->connector->send(
            new CreateEnvelopeRequest($envelope)
        );

        return Envelope::fromArray($response->json());
    }

    public function dispatch(string $id): bool
    {
        return $this->connector->send(
            new SendEnvelopeRequest($id)
        )->successful();
    }
}
