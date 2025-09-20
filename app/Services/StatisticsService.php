<?php

namespace App\Services;

use App\Models\Ticket;

class StatisticsService
{
    public function getStatistics(): array
    {
        return [
            'today' => Ticket::today()->count(),
            'week'  => Ticket::thisWeek()->count(),
            'month' => Ticket::thisMonth()->count(),
        ];
    }
}
