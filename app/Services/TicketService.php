<?php

namespace App\Services;

use App\DTO\TicketData;
use App\DTO\TicketFilterData;
use App\DTO\TicketStatusData;
use App\Models\Customer;
use App\Models\Ticket;
use App\Repositories\TicketRepository;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class TicketService
{
    public function __construct(private readonly TicketRepository $ticketRepository) {}

    /**
     * @throws Exception
     */
    public function create(TicketData $data): Ticket
    {
        try {
            $customer = Customer::where('email', $data->email)
                ->orWhere('phone', $data->phone)
                ->first();

            // !updateOrCreate - не использую, так как ищет точно совпадающие все поля
            // из первого массива одновременно, а меня интересует "ИЛИ"
            if (!$customer) {
                $customer = Customer::create([
                    'name' => $data->name,
                    'email' => $data->email,
                    'phone' => $data->phone,
                ]);
            } else {
                $customer->update([
                    'name' => $data->name,
                    'email' => $data->email,
                    'phone' => $data->phone,
                ]);
            }
            return DB::transaction(function () use ($customer, $data) {
                $ticket = $this->ticketRepository->createForCustomer($customer, [
                    'subject' => $data->subject,
                    'message' => $data->message,
                    'status' => 'new',
                ]);

                foreach ($data->files as $file) {
                    try {
                        $ticket->addMedia($file)->toMediaCollection('files');
                    } catch (Exception $e) {
                        Log::error('Ошибка MediaLibrary: ' . $e->getMessage());
                        throw $e;
                    }
                }

                return $ticket;
            });
        } catch (Exception $exception) {
            Log::error('Что-то пошло не так', ['errorMessage' => $exception->getMessage()]);
            throw $exception;
        }
    }

    public function changeStatus(Ticket $ticket, TicketStatusData $data): Ticket
    {
        $ticket->update(['status' => $data->status]);
        return $ticket;
    }

    public function getTickets(TicketFilterData $filter)
    {
        return $this->ticketRepository->getFiltered($filter);
    }
}
