@extends('layouts.admin')

@section('content')
    <h2 class="text-xl font-semibold mb-4">Список клиентов</h2>
    <table class="w-full border border-gray-300 mb-4">
        <thead>
        <tr class="bg-gray-200">
            <th class="border px-2 py-1">ID</th>
            <th class="border px-2 py-1">Имя</th>
            <th class="border px-2 py-1">Email</th>
            <th class="border px-2 py-1">Телефон</th>
        </tr>
        </thead>
        <tbody>
        @foreach($customers as $customer)
            <tr>
                <td class="border px-2 py-1">{{ $customer->id }}</td>
                <td class="border px-2 py-1">{{ $customer->name }}</td>
                <td class="border px-2 py-1">{{ $customer->email }}</td>
                <td class="border px-2 py-1">{{ $customer->phone }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="mt-2">
        {{ $customers->links() }}
    </div>
@endsection
