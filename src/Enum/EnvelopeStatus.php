<?php

declare(strict_types=1);

namespace Dyrynda\Annature\Enum;

enum EnvelopeStatus: string
{
    case Draft = 'draft';

    case Created = 'created';

    case Sent = 'sent';

    case Completed = 'completed';

    case Voided = 'voided';
}
