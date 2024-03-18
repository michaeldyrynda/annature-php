<?php

declare(strict_types=1);

namespace Dyrynda\Annature\Resources;

use Dyrynda\Annature\Data\Document;
use Dyrynda\Annature\Requests\Documents\GetDocumentRequest;
use Dyrynda\Annature\Requests\Documents\ListDocumentsRequest;
use Illuminate\Support\Collection;

class Documents extends Resource
{
    public function list(string $envelopeId, ?int $duration = 60): Collection
    {
        $response = $this->connector->send(
            new ListDocumentsRequest($envelopeId, $duration)
        );

        return collect($response->json())->map(fn (array $document) => Document::fromArray($document));
    }

    public function get(string $envelopeId, string $documentId, ?int $duration = 60): Document
    {
        $response = $this->connector->send(
            new GetDocumentRequest($envelopeId, $documentId, $duration)
        );

        return Document::fromArray($response->json());
    }
}
