<?php

declare(strict_types=1);

namespace Dyrynda\Annature\Requests\Envelopes;

use Dyrynda\Annature\Data\Document;
use Dyrynda\Annature\Data\Envelope;
use Dyrynda\Annature\Data\Recipient;
use Saloon\Enums\Method;
use Saloon\Http\Request;

class CreateEnvelopeRequest extends Request
{
    protected Method $method = Method::POST;

    public function __construct(
        protected Envelope $envelope,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/v1/envelopes';
    }

    protected function defaultBody(): array
    {
        var_dump([
            'name' => $this->envelope->name,
            'message' => $this->envelope->message,
            'shared' => $this->envelope->shared ?: false,
            'draft' => $this->envelope->draft ?: false,
            'account_id' => $this->envelope->accountId,
            'group_id' => $this->envelope->groupId,
            'documents' => $this->envelope->documents->mapWithKeys(function (Document $document) {
                return array_filter([
                    'id' => $document->id,
                    'name' => $document->name,
                    'base' => $document->base,
                ]);
            })->all(),
            'recipients' => $this->envelope->recipients->mapWithKeys(function (Recipient $recipient) {
                return array_filter([
                    'name' => $recipient->name,
                    'email' => $recipient->email,
                    'mobile' => $recipient->mobile,
                    'type' => $recipient->type->value,
                    'message' => $recipient->message,
                    'password' => $recipient->password,
                    'muted' => $recipient->muted,
                    'order' => $recipient->order,
                    'redirects' => $recipient->redirects->toArray(),
                    'fields' => $this->envelope->draft ? $recipient->fields->toArray() : [],
                    'metadata' => $recipient->metadata,
                ]);
            }),
        ]);

        exit();
    }
}
