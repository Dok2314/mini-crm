<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Services\StatisticsService;

class StatisticsController extends Controller
{
    public function __construct(public readonly StatisticsService $statisticsService) {}

    public function index()
    {
        return response()->json($this->statisticsService->getStatistics());
    }
}
