<?php

namespace App\Repositories;

use App\DTO\TicketFilterData;
use App\Models\Ticket;
use App\Models\Customer;

class TicketRepository
{
    public function createForCustomer(Customer $customer, array $data): Ticket
    {
        return $customer->tickets()->create($data);
    }

    public function findById(int $id): ?Ticket
    {
        return Ticket::with('customer', 'media')->find($id);
    }


    public function query()
    {
        return Ticket::query()->with('customer');
    }

    public function getFiltered(TicketFilterData $filter)
    {
        $allowedSorts = ['id', 'created_at', 'status', 'subject'];
        $sortBy = in_array($filter->sortBy, $allowedSorts) ? $filter->sortBy : 'created_at';
        $sortOrder = strtolower($filter->sortOrder) === 'asc' ? 'asc' : 'desc';

        $query = $this->query();

        if ($filter->email) $query->email($filter->email);
        if ($filter->phone) $query->phone($filter->phone);
        if ($filter->status) $query->status($filter->status);
        if ($filter->from || $filter->to) $query->dateRange($filter->from, $filter->to);

        return $query->orderBy($sortBy, $sortOrder)->paginate($filter->perPage)->withQueryString();
    }

    public function getStatistics(string $period = 'day'): array
    {
        $query = Ticket::query();
        switch ($period) {
            case 'week':
                $query->where('created_at', '>=', now()->subWeek());
                break;
            case 'month':
                $query->where('created_at', '>=', now()->subMonth());
                break;
            default:
                $query->where('created_at', '>=', now()->subDay());
        }

        return [
            'count' => $query->count(),
            'new' => $query->where('status', 'new')->count(),
            'in_progress' => $query->where('status', 'in_progress')->count(),
            'processed' => $query->where('status', 'processed')->count(),
        ];
    }
}
