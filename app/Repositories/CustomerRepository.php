<?php

namespace App\Repositories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Collection;

class CustomerRepository
{
    public function findByEmail(string $email): ?Customer
    {
        return Customer::where('email', $email)->first();
    }

    public function firstOrCreate(array $attributes, array $values = []): Customer
    {
        return Customer::firstOrCreate($attributes, $values);
    }

    public function getTickets(Customer $customer): Collection
    {
        return $customer->tickets()->get();
    }

    public function update(Customer $customer, array $data): Customer
    {
        $customer->update($data);
        return $customer;
    }

    public function delete(Customer $customer): bool
    {
        return $customer->delete();
    }
}
