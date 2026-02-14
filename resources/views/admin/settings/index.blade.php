@extends('layouts.admin')

@section('content')

<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">

    <h2 class="text-2xl font-semibold mb-6">Company Settings</h2>

    @if(session('success'))
        <div class="mb-4 bg-green-100 text-green-700 p-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.settings.update') }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-2 gap-4">

            <div>
                <label class="block mb-1 font-medium">Company Name</label>
                <input type="text"
                       name="company_name"
                       value="{{ $setting->company_name }}"
                       class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block mb-1 font-medium">Company Email</label>
                <input type="email"
                       name="company_email"
                       value="{{ $setting->company_email }}"
                       class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block mb-1 font-medium">Company Phone</label>
                <input type="text"
                       name="company_phone"
                       value="{{ $setting->company_phone }}"
                       class="w-full border rounded px-3 py-2">
            </div>

        </div>

        <div class="mt-4">
            <label class="block mb-1 font-medium">Company Address</label>
            <textarea name="company_address"
                      class="w-full border rounded px-3 py-2">{{ $setting->company_address }}</textarea>
        </div>

        <div class="mt-4">
            <label class="block mb-1 font-medium">Company Logo</label>

            @if($setting->company_logo)
                <img src="{{ asset('storage/'.$setting->company_logo) }}"
                     class="h-16 mb-3">
            @endif

            <input type="file"
                   name="company_logo"
                   class="w-full border rounded px-3 py-2">
        </div>

        <button class="mt-6 bg-blue-600 text-white px-6 py-2 rounded">
            Update Settings
        </button>

    </form>

</div>

@endsection
