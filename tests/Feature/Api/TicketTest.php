<?php

use App\Models\Customer;
use App\Models\Ticket;
use Illuminate\Foundation\Testing\RefreshDatabase;
uses(RefreshDatabase::class)->in(__FILE__);

test('it can create a ticket with valid data', function () {
    $data = [
        'name' => 'Test',
        'phone' => '+1234567890',
        'email' => 'test@example.com',
        'subject' => 'Test Subject',
        'message' => 'Test message',
    ];

    $response = $this->postJson(route('api.tickets.store'), $data);

    $response
        ->assertStatus(201)
        ->assertJson([
            'message' => 'Заявка успешно создана',
        ])
        ->assertJsonStructure([
            'ticket' => [
                'id',
                'subject',
                'message',
                'status',
                'customer' => [
                    'name',
                    'email',
                    'phone',
                ],
                'files',
            ],
        ]);

    expect(Customer::where('email', 'test@example.com')->exists())->toBeTrue();
    expect(Customer::where('phone', '+1234567890')->exists())->toBeTrue();

    $ticket = Ticket::whereHas('customer', function ($query) {
        $query->where('email', 'test@example.com');
    })->first();

    expect($ticket)
        ->subject->toBe('Test Subject')
        ->message->toBe('Test message')
        ->status->toBe('new');
});

test('it validates ticket creation data', function () {
    $invalidData = [
        'name' => 'John',
        'phone' => 'invalid',
    ];

    $response = $this->postJson(route('api.tickets.store'), $invalidData);

    $response
        ->assertStatus(422)
        ->assertJsonValidationErrors(['phone', 'email']);
});
