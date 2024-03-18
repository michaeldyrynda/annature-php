<?php

declare(strict_types=1);

use Dyrynda\Annature\Annature;
use Dyrynda\Annature\Data\CreateDocumentData;
use Dyrynda\Annature\Data\CreateEnvelopeData;
use Dyrynda\Annature\Data\CreateRecipientData;
use Dyrynda\Annature\Data\Envelope;
use Dyrynda\Annature\Enum\RecipientType;
use Dyrynda\Annature\Requests\Envelopes\CreateEnvelopeRequest;
use Dyrynda\Annature\Requests\Envelopes\DeleteEnvelopeRequest;
use Dyrynda\Annature\Requests\Envelopes\GetEnvelopeRequest;
use Dyrynda\Annature\Requests\Envelopes\ListEnvelopesRequest;
use Dyrynda\Annature\Requests\Envelopes\SendEnvelopeRequest;
use Dyrynda\Annature\Requests\Envelopes\VoidEnvelopeRequest;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Tests\Fixtures\Saloon\CreateEnvelopeFixture;

beforeEach(function () {
    $this->envelopes = (new Annature('abc123', 'def456'))->envelopes();
});

it('can load a list of envelopes', function () {
    MockClient::global([
        ListEnvelopesRequest::class => MockResponse::fixture('responses/envelopes/list'),
    ]);

    expect($this->envelopes->list())
        ->toMatchSnapshot()
        ->toContainOnlyInstancesOf(Envelope::class);
});

it('can load a single envelope', function () {
    MockClient::global([
        GetEnvelopeRequest::class => MockResponse::fixture('responses/envelopes/get'),
    ]);

    $account = $this->envelopes->get('abc123');

    expect($account)
        ->toMatchSnapshot()
        ->toBeInstanceOf(Envelope::class)
        ->id->toBe('abc123');
});

it('can create a new envelope', function () {
    MockClient::global([
        CreateEnvelopeRequest::class => new CreateEnvelopeFixture,
    ]);

    $envelope = $this->envelopes->create(new CreateEnvelopeData(
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

it('can send an existing draft envelope', function () {
    MockClient::global([
        SendEnvelopeRequest::class => MockResponse::make(status: 204),
    ]);

    expect($this->envelopes->dispatch('abc123'))->toBeTrue();
});

it('can void a sent envelope', function () {
    MockClient::global([
        VoidEnvelopeRequest::class => MockResponse::make(status: 204),
    ]);

    expect($this->envelopes->void('abc123'))->toBeTrue();
});

it('can delete a draft envelope', function () {
    MockClient::global([
        DeleteEnvelopeRequest::class => MockResponse::make(status: 204),
    ]);

    expect($this->envelopes->delete('abc123'))->toBeTrue();
});
