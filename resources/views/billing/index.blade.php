@extends('layouts.admin')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200 px-4">

    <div class="bg-white w-full max-w-md rounded-2xl shadow-xl p-8 text-center">

        <!-- Icon -->
        <div class="flex justify-center mb-4">
            <div class="bg-red-100 text-red-500 p-4 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M6.938 4h10.124c1.054 0 1.9.816 1.9 1.82v12.36c0 1.004-.846 1.82-1.9 1.82H6.938c-1.054 0-1.9-.816-1.9-1.82V5.82c0-1.004.846-1.82 1.9-1.82z" />
                </svg>
            </div>
        </div>

        <!-- Title -->
        <h2 class="text-2xl font-bold text-gray-800 mb-2">
            Subscription Expired
        </h2>

        <!-- Subtitle -->
        <p class="text-gray-500 mb-6">
            Your plan has expired. Upgrade now to continue using all features without interruption.
        </p>

        <!-- Plan Info -->
        <div class="bg-gray-100 rounded-lg p-4 mb-6">
            <p class="text-sm text-gray-500">Last Plan</p>
            <p class="font-semibold text-gray-800">Basic Plan</p>
        </div>

        <!-- Buttons -->
        <div class="space-y-3">
            <a href="#" 
               class="block w-full bg-blue-600 text-white py-3 rounded-xl font-medium hover:bg-blue-700 transition">
                🚀 Upgrade Plan
            </a>

            <a href="{{ url('/') }}" 
               class="block w-full border border-gray-300 py-3 rounded-xl text-gray-700 hover:bg-gray-100 transition">
                Back to Home
            </a>
        </div>

    </div>

</div>
@endsection