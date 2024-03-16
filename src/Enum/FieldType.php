<?php

declare(strict_types=1);

namespace Dyrynda\Annature\Enum;

enum FieldType: string
{
    case Signature = 'signature';

    case Initials = 'initials';

    case Witness = 'witness';

    case Date = 'date';

    case Input = 'input';

    case Checkbox = 'checkbox';

    case Dropdown = 'dropdown';
}
