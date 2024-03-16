<?php

declare(strict_types=1);

namespace Dyrynda\Annature\Enum;

enum RecipientStatus: string
{
    case Created = 'created';

    case Pending = 'pending';

    case Sent = 'sent';

    case Failed = 'failed';

    case Completed = 'completed';

    case Declined = 'declined';
}
