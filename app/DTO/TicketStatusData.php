<?php

namespace App\DTO;

use Illuminate\Http\Request;

readonly class TicketStatusData
{
    public function __construct(
        public string $status
    ) {}

    public static function fromRequest(Request $request): self
    {
        $request->validate([
            'status' => 'required|in:new,in_progress,processed'
        ]);

        return new self(
            status: $request->input('status')
        );
    }
}
