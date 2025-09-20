<?php

namespace App\Services;

use App\Models\Customer;

class CustomerService
{
    public function getCustomers()
    {
        return Customer::latest()->paginate(5);
    }
}
