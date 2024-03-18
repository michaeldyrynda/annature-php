<?php

declare(strict_types=1);

namespace Tests\Fixtures\Saloon;

use Saloon\Http\Faking\Fixture;

class GetDocumentFixture extends Fixture
{
    protected function defineName(): string
    {
        return 'responses/documents/get';
    }

    protected function defineSensitiveJsonParameters(): array
    {
        return [
            'id' => 'def456',
            'original' => 'https://annature.test/documents/original?expiry=later',
            'master' => 'https://annature.test/documents/master?expiry=also-later',
        ];
    }
}
