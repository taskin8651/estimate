@extends('layouts.admin')

@section('content')

<div class="max-w-3xl mx-auto">

    <div class="mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">
            Add Mail Setting
        </h2>
        <p class="text-sm text-gray-500">
            Configure your SMTP credentials to send emails.
        </p>
    </div>

    <div class="bg-white shadow rounded-lg border border-gray-200 p-6">

        <form method="POST" action="{{ route('admin.mail-settings.store') }}">
        @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- SMTP HOST --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        SMTP Host
                    </label>
                    <input type="text"
                           name="host"
                           value="{{ old('host') }}"
                           placeholder="smtp.hostinger.com"
                           class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                {{-- PORT --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Port
                    </label>
                    <input type="text"
                           name="port"
                           value="{{ old('port') }}"
                           placeholder="587"
                           class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                {{-- USERNAME --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Username
                    </label>
                    <input type="text"
                           name="username"
                           value="{{ old('username') }}"
                           placeholder="info@domain.com"
                           class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                {{-- PASSWORD --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Password
                    </label>
                    <input type="password"
                           name="password"
                           placeholder="Enter SMTP Password"
                           class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                {{-- ENCRYPTION --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Encryption
                    </label>
                    <select name="encryption"
                            class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        <option value="">Select Encryption</option>
                        <option value="tls">TLS</option>
                        <option value="ssl">SSL</option>
                    </select>
                </div>

                {{-- FROM EMAIL --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        From Email
                    </label>
                    <input type="email"
                           name="from_address"
                           value="{{ old('from_address') }}"
                           placeholder="info@domain.com"
                           class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                {{-- FROM NAME --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        From Name
                    </label>
                    <input type="text"
                           name="from_name"
                           value="{{ old('from_name') }}"
                           placeholder="Company Name"
                           class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

            </div>

            {{-- BUTTONS --}}
            <div class="mt-6 flex justify-end gap-3">

                <a href="{{ route('admin.mail-settings.index') }}"
                   class="px-4 py-2 text-sm bg-gray-200 rounded hover:bg-gray-300 transition">
                    Cancel
                </a>

                <button type="submit"
                        class="px-5 py-2 text-sm bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                    Save Setting
                </button>

            </div>

        </form>

    </div>

</div>

@endsection
