<?php

declare(strict_types=1);

namespace Dyrynda\Annature\Enum;

enum RecipientType: string
{
    case Signer = 'signer';

    case Viewer = 'viewer';

    case CarbonCopy = 'carbon-copy';
}
