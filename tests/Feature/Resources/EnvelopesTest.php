<?php

declare(strict_types=1);

use Dyrynda\Annature\Annature;
use Dyrynda\Annature\Data\CreateDocumentData;
use Dyrynda\Annature\Data\CreateEnvelopeData;
use Dyrynda\Annature\Data\CreateRecipientData;
use Dyrynda\Annature\Data\Envelope;
use Dyrynda\Annature\Enum\RecipientType;
use Dyrynda\Annature\Requests\Envelopes\CreateEnvelopeRequest;
use Dyrynda\Annature\Requests\Envelopes\GetEnvelopeRequest;
use Dyrynda\Annature\Requests\Envelopes\ListEnvelopesRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

beforeEach(function () {
    $this->resource = (new Annature('abc123', 'def456'))->envelopes();
});

it('can load a list of envelopes', function () {
    MockClient::global([
        ListEnvelopesRequest::class => MockResponse::fixture('responses/envelopes/list'),
    ]);

    expect($this->resource->list())
        ->toMatchSnapshot()
        ->toContainOnlyInstancesOf(Envelope::class);
});

it('can load a single envelope', function () {
    MockClient::global([
        GetEnvelopeRequest::class => MockResponse::fixture('responses/envelopes/get'),
    ]);

    $account = $this->resource->get('abc123');

    expect($account)
        ->toMatchSnapshot()
        ->toBeInstanceOf(Envelope::class)
        ->id->toBe('abc123');
});

it('can create a new envelope', function () {
    MockClient::global([
        CreateEnvelopeRequest::class => MockResponse::fixture('responses/envelopes/create'),
    ]);

    $envelope = $this->resource->create(new CreateEnvelopeData(
        name: 'My Test Envelope',
        message: 'My test envelope message',
        shared: false,
        draft: true,
        accountId: 'def456',
        documents: collect([
            new CreateDocumentData(
                base: file_get_contents(__DIR__.'/../../Fixtures/pdf.base'),
                name: 'my-test.pdf'
            ),
        ]),
        recipients: collect([
            new CreateRecipientData(
                name: 'Michael Dyrynda',
                email: 'michael@annature.test',
                type: RecipientType::Signer,
            ),
        ]),
    ));

    expect($envelope)
        ->toMatchSnapshot()
        ->toBeInstanceOf(Envelope::class)
        ->id->toBe('abc123');
});
