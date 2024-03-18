<?php

declare(strict_types=1);

namespace Dyrynda\Annature\Contracts;

use Dyrynda\Annature\Resources;

interface AnnatureClient
{
    public function accounts(): Resources\Accounts;

    public function documents(): Resources\Documents;

    public function endpoints(): Resources\Endpoints;

    public function envelopes(): Resources\Envelopes;

    public function fields(): Resources\Fields;

    public function groups(): Resources\Groups;

    public function organisations(): Resources\Organisations;

    public function recipients(): Resources\Recipients;

    public function templates(): Resources\Templates;
}
