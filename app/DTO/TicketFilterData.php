<?php

namespace App\DTO;

use Illuminate\Http\Request;

readonly class TicketFilterData
{
    public function __construct(
        public ?string $email,
        public ?string $phone,
        public ?string $status,
        public ?string $from,
        public ?string $to,
        public string $sortBy = 'created_at',
        public string $sortOrder = 'desc',
        public int $perPage = 15
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            email: $request->input('email'),
            phone: $request->input('phone'),
            status: $request->input('status'),
            from: $request->input('from'),
            to: $request->input('to'),
            sortBy: $request->input('sort_by', 'created_at'),
            sortOrder: $request->input('sort_order', 'desc'),
            perPage: (int) $request->input('per_page', 15),
        );
    }
}
