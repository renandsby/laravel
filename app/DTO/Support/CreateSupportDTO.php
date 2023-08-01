<?php

namespace App\DTO\Support;

use App\Enuns\SupportStatus;
use App\Http\Requests\StoreUpdateSupports;

class CreateSupportDTO
{
    public function __construct(
        public string $subject,
        public SupportStatus $status,
        public string $body,
    )
    {}

    public static function makeFromRequest(StoreUpdateSupports $request) : self
    {
        return new self(
            $request->subject,
            SupportStatus::A,
            $request->body,
        );
    }
}
