<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Services\CustomerService;

class CustomerController extends Controller
{
    public function __construct(public readonly CustomerService $customerService) {}

    public function index()
    {
        $customers = $this->customerService->getCustomers();
        return view('admin.customers.index', compact('customers'));
    }
}
