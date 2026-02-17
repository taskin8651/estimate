@extends('layouts.admin')

@section('content')

<div class="max-w-3xl mx-auto">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">
            Mail Settings
        </h2>
    </div>

    <div class="bg-white shadow rounded-lg border border-gray-200 p-6">

        @if($setting)

            <div class="space-y-4 text-sm">

                <div class="flex justify-between border-b pb-2">
                    <span class="text-gray-600 font-medium">SMTP Host</span>
                    <span class="text-gray-800">{{ $setting->host }}</span>
                </div>

                <div class="flex justify-between border-b pb-2">
                    <span class="text-gray-600 font-medium">Port</span>
                    <span class="text-gray-800">{{ $setting->port }}</span>
                </div>

                <div class="flex justify-between border-b pb-2">
                    <span class="text-gray-600 font-medium">Username</span>
                    <span class="text-gray-800">{{ $setting->username }}</span>
                </div>

                <div class="flex justify-between border-b pb-2">
                    <span class="text-gray-600 font-medium">From Email</span>
                    <span class="text-gray-800">{{ $setting->from_address }}</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-gray-600 font-medium">From Name</span>
                    <span class="text-gray-800">{{ $setting->from_name }}</span>
                </div>

            </div>

            {{-- ACTION BUTTONS --}}
            <div class="flex items-center gap-3 mt-6">

                <a href="{{ route('admin.mail-settings.edit',$setting->id) }}"
                   class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition text-sm">
                    Edit
                </a>

                <form method="POST"
                      action="{{ route('admin.mail-settings.destroy',$setting->id) }}">
                    @csrf
                    @method('DELETE')

                    <button type="submit"
                            onclick="return confirm('Are you sure?')"
                            class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition text-sm">
                        Delete
                    </button>
                </form>

            </div>

        @else

            <div class="text-center py-10">
                <p class="text-gray-500 mb-4">
                    No SMTP settings configured yet.
                </p>

                <a href="{{ route('admin.mail-settings.create') }}"
                   class="px-5 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition text-sm">
                    Add SMTP Settings
                </a>
            </div>

        @endif

    </div>

</div>

@endsection
