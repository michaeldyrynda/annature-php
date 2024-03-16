<?php

use Dyrynda\Annature\Annature;
use Dyrynda\Annature\Data\Envelope;
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
