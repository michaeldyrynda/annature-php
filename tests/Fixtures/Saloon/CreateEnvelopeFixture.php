<?php

declare(strict_types=1);

namespace Tests\Fixtures\Saloon;

use Saloon\Http\Faking\Fixture;

class CreateEnvelopeFixture extends Fixture
{
    protected function defineName(): string
    {
        return 'responses/envelopes/create';
    }

    protected function defineSensitiveJsonParameters(): array
    {
        return [
            'id' => 'abc123',
            'account_id' => 'def456',
            'group_id' => null,
        ];
    }
}
