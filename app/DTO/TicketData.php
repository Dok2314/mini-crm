<?php

namespace App\DTO;

use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;

readonly class TicketData
{
    public function __construct(
        public string $name,
        public string $phone,
        public string $email,
        public string $subject,
        public string $message,
        /** @var UploadedFile[] */
        public array $files = []
    ) {
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            name: $request->input('name'),
            phone: $request->input('phone'),
            email: $request->input('email'),
            subject: $request->input('subject'),
            message: $request->input('message'),
            files: $request->file('files', [])
        );
    }
}
