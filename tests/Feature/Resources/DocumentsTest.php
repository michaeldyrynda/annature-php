<?php

declare(strict_types=1);

use Dyrynda\Annature\Annature;
use Dyrynda\Annature\Data\Document;
use Dyrynda\Annature\Requests\Documents\GetDocumentRequest;
use Dyrynda\Annature\Requests\Documents\ListDocumentsRequest;
use Saloon\Http\Faking\MockClient;
use Tests\Fixtures\Saloon\GetDocumentFixture;
use Tests\Fixtures\Saloon\ListDocumentsFixture;

beforeEach(function () {
    $this->documents = (new Annature('abc123', 'def456'))->documents();
});

it('can load a list of documents for an envelope', function () {
    MockClient::global([
        ListDocumentsRequest::class => new ListDocumentsFixture,
    ]);

    expect($this->documents->list('abc123'))
        ->toMatchSnapshot()
        ->toContainOnlyInstancesOf(Document::class)
        ->first()->id->toBe('abc123');
});

it('can load a single document', function () {
    MockClient::global([
        GetDocumentRequest::class => new GetDocumentFixture,
    ]);

    expect($this->documents->get('abc123', 'def456'))
        ->toMatchSnapshot()
        ->toBeInstanceOf(Document::class)
        ->id->toBe('def456');
});
