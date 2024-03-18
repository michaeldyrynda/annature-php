<?php

declare(strict_types=1);

namespace Tests\Fixtures\Saloon;

use Saloon\Http\Faking\Fixture;

class ListDocumentsFixture extends Fixture
{
    protected function defineName(): string
    {
        return 'responses/documents/list';
    }

    protected function defineSensitiveJsonParameters(): array
    {
        return [
            'id' => 'abc123',
            'original' => 'https://annature.test/documents/original?expiry=later',
            'master' => 'https://annature.test/documents/master?expiry=also-later',
        ];
    }
}
