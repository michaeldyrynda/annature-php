<?php

declare(strict_types=1);

namespace Dyrynda\Annature\Resources;

use Dyrynda\Annature\Annature;
use RuntimeException;
use Saloon\Http\Request;
use Saloon\Http\Response;

abstract class Resource
{
    public function __construct(
        protected Annature $connector,
    ) {
    }

    public function send(Request $request): Response
    {
        $response = $this->connector->send($request);

        if ($response->failed()) {
            throw new RuntimeException('The request could not be completed.');
        }

        return $response;
    }
}
