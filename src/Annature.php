<?php

declare(strict_types=1);

namespace Dyrynda\Annature;

use Saloon\Http\Connector;
use Saloon\Traits\Plugins\AcceptsJson;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;

class Annature extends Connector
{
    use AcceptsJson;
    use AlwaysThrowOnErrors;

    public function __construct(
        protected string $id,
        protected string $key
    ) {
    }

    public function resolveBaseUrl(): string
    {
        return 'https://api.annature.com.au';
    }

    protected function defaultHeaders(): array
    {
        return [
            'X-Annature-Id' => $this->id,
            'X-Annature-Key' => $this->key,
        ];
    }

    public function accounts(): Resources\Accounts
    {
        return new Resources\Accounts($this);
    }

    public function documents(): Resources\Documents
    {
        return new Resources\Documents($this);
    }

    public function endpoints(): Resources\Endpoints
    {
        return new Resources\Endpoints($this);
    }

    public function envelopes(): Resources\Envelopes
    {
        return new Resources\Envelopes($this);
    }

    public function fields(): Resources\Fields
    {
        return new Resources\Fields($this);
    }

    public function groups(): Resources\Groups
    {
        return new Resources\Groups($this);
    }

    public function organisations(): Resources\Organisations
    {
        return new Resources\Organisations($this);
    }

    public function recipients(): Resources\Recipients
    {
        return new Resources\Recipients($this);
    }

    public function templates(): Resources\Templates
    {
        return new Resources\Templates($this);
    }
}
