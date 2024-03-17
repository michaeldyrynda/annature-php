<?php

declare(strict_types=1);

namespace Dyrynda\Annature\Data;

use Dyrynda\Annature\Enum\RecipientType;
use Illuminate\Support\Collection;

final readonly class CreateRecipientData extends Data
{
    /** @var \Illuminate\Support\Collection<array-key, \Dyrynda\Annature\Data\CreateFieldData> */
    public Collection $fields;

    public RecipientType $type;

    /**
     * @param \Illuminate\Support\Collection<array-key, \Dyrynda\Annature\Data\CreateFieldData> $fields
     */
    public function __construct(
        public string $name,
        public string $email,
        public bool $muted = false,
        public ?string $mobile = null,
        public ?string $message = null,
        public ?string $password = null,
        public ?int $order = null,
        public ?Redirects $redirects = null,
        ?Collection $fields = null,
        ?RecipientType $type = null,
    ) {
        $this->fields = $fields ?: collect();
        $this->type = $type ?: RecipientType::Signer;
    }

    public function toArray(): array
    {
        return array_filter([
            'name' => $this->name,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'message' => $this->message,
            'password' => $this->password,
            'muted' => $this->muted,
            'order' => $this->order,
            'redirects' => $this->redirects?->toArray(),
            'fields' => $this->fields->toArray(),
            'type' => $this->type->value,
        ], fn ($value) => ! is_null($value) && ! empty($value));
    }
}
