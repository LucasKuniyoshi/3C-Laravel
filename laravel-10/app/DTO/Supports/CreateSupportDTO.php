<?php

namespace App\DTO\Supports;

use App\Enums\SupportStatus;
use App\Http\Requests\StoreUpdateSupport;

class CreateSupportDTO
{
    public function __construct(
        public string $subject,
        public SupportStatus $status,
        public string $body,
    ) {}

    public static function makeFromRequest(StoreUpdateSupport $request): self //self => objeto da prórpia classe
    {
        return new self(
            $request->subject,
            SupportStatus::A, // "a"
            $request->body
        );
    }
}
