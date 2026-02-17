@extends('layouts.admin')

@section('content')

<div class="p-6 space-y-8">

    {{-- ================= HEADER ================= --}}
    <div>
        <h1 class="text-2xl font-bold text-gray-800">
            Dashboard
        </h1>
        <p class="text-sm text-gray-500">
            Welcome back, {{ auth()->user()->name }}
        </p>
    </div>


    {{-- ================= STAT CARDS ================= --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        @isset($totalUsers)
        <div class="bg-white p-6 rounded-xl shadow border">
            <p class="text-sm text-gray-500">Total Users</p>
            <h2 class="text-2xl font-bold text-indigo-600">
                {{ $totalUsers }}
            </h2>
        </div>
        @endisset

        <div class="bg-white p-6 rounded-xl shadow border">
            <p class="text-sm text-gray-500">Total Clients</p>
            <h2 class="text-2xl font-bold text-blue-600">
                {{ $totalClients }}
            </h2>
        </div>

        <div class="bg-white p-6 rounded-xl shadow border">
            <p class="text-sm text-gray-500">Total Estimates</p>
            <h2 class="text-2xl font-bold text-purple-600">
                {{ $totalEstimates }}
            </h2>
        </div>

        <div class="bg-white p-6 rounded-xl shadow border">
            <p class="text-sm text-gray-500">Total Revenue</p>
            <h2 class="text-2xl font-bold text-green-600">
                ₹ {{ number_format($totalRevenue,2) }}
            </h2>
        </div>

    </div>


    {{-- ================= CHARTS SECTION ================= --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- 📊 Monthly Revenue Chart --}}
        <div class="bg-white p-6 rounded-xl shadow border">
            <h2 class="text-lg font-semibold mb-4">
                Monthly Revenue ({{ date('Y') }})
            </h2>
            <canvas id="revenueChart" height="100"></canvas>
        </div>


        {{-- 📈 Status Analytics --}}
        <div class="bg-white p-6 rounded-xl shadow border">
            <h2 class="text-lg font-semibold mb-4">
                Estimate Status Analytics
            </h2>
            <canvas id="statusChart" height="100"></canvas>
        </div>

    </div>


    {{-- ================= MONTHLY BREAKDOWN TABLE ================= --}}
    <div class="bg-white p-6 rounded-xl shadow border">

        <h2 class="text-lg font-semibold mb-4">
            Monthly Revenue Breakdown
        </h2>

        <table class="w-full text-sm border-collapse">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 text-left">Month</th>
                    <th class="p-3 text-right">Revenue</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $months = [
                        'January','February','March','April','May','June',
                        'July','August','September','October','November','December'
                    ];
                @endphp

                @foreach($monthlyRevenue as $index => $value)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3">
                        {{ $months[$index] }}
                    </td>
                    <td class="p-3 text-right font-semibold text-indigo-600">
                        ₹ {{ number_format($value,2) }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>


    {{-- ================= RECENT ESTIMATES ================= --}}
    <div class="bg-white p-6 rounded-xl shadow border">

        <h2 class="text-lg font-semibold mb-4">
            Recent Estimates
        </h2>

        <table class="w-full text-sm border-collapse">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 text-left">Estimate #</th>
                    <th class="p-3 text-left">Client</th>
                    <th class="p-3 text-left">Date</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentEstimates as $estimate)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3">{{ $estimate->estimate_number }}</td>
                    <td class="p-3">{{ $estimate->client->name ?? '-' }}</td>
                    <td class="p-3">{{ $estimate->issue_date }}</td>
                    <td class="p-3 capitalize">
                        {{ $estimate->status }}
                    </td>
                    <td class="p-3 text-right font-semibold text-indigo-600">
                        ₹ {{ number_format($estimate->total,2) }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>

</div>


{{-- ================= CHART JS ================= --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Monthly Revenue Chart
    const revenueCtx = document.getElementById('revenueChart');

    new Chart(revenueCtx, {
        type: 'line',
        data: {
            labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
            datasets: [{
                label: 'Revenue',
                data: @json($monthlyRevenue),
                borderColor: '#6366f1',
                backgroundColor: 'rgba(99,102,241,0.1)',
                tension: 0.4,
                fill: true
            }]
        }
    });


    // Status Pie Chart
    const statusCtx = document.getElementById('statusChart');

    new Chart(statusCtx, {
        type: 'pie',
        data: {
            labels: ['Draft','Sent','Approved','Rejected'],
            datasets: [{
                data: [
                    {{ $statusCounts['draft'] }},
                    {{ $statusCounts['sent'] }},
                    {{ $statusCounts['approved'] }},
                    {{ $statusCounts['rejected'] }}
                ],
                backgroundColor: [
                    '#9ca3af',
                    '#3b82f6',
                    '#10b981',
                    '#ef4444'
                ]
            }]
        }
    });
</script>

@endsection
