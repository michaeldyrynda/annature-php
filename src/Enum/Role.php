<?php

declare(strict_types=1);

namespace Dyrynda\Annature\Enum;

enum Role: string
{
    case Administrator = 'administrator';

    case Standard = 'standard';

    case ReadOnly = 'read-only';
}
