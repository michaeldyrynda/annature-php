<?php

use Dyrynda\Annature\Annature;
use Dyrynda\Annature\Resources;

beforeEach(function () {
    $this->annature = new Annature('annature-id', 'annature-secret');
});

it('returns an accounts resource', function () {
    expect($this->annature->accounts())->toBeInstanceOf(Resources\Accounts::class);
});

it('returns a documents resource', function () {
    expect($this->annature->documents())->toBeInstanceOf(Resources\Documents::class);
});

it('returns an endpoints resource', function () {
    expect($this->annature->endpoints())->toBeInstanceOf(Resources\Endpoints::class);
});

it('returns an envelopes resource', function () {
    expect($this->annature->envelopes())->toBeInstanceOf(Resources\Envelopes::class);
});

it('returns a fields resource', function () {
    expect($this->annature->fields())->toBeInstanceOf(Resources\Fields::class);
});

it('returns a groups resource', function () {
    expect($this->annature->groups())->toBeInstanceOf(Resources\Groups::class);
});

it('returns an organisations resource', function () {
    expect($this->annature->organisations())->toBeInstanceOf(Resources\Organisations::class);
});

it('returns a recipients resource', function () {
    expect($this->annature->recipients())->toBeInstanceOf(Resources\Recipients::class);
});

it('returns a templates resource', function () {
    expect($this->annature->templates())->toBeInstanceOf(Resources\Templates::class);
});
