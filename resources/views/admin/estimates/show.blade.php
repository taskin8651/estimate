@extends('layouts.admin')

@section('content')

@php
$template = $estimate->template ?? 'classic';
@endphp

<style>
@media print {

    body * {
        visibility: hidden;
    }

    #print-area, #print-area * {
        visibility: visible;
    }

    #print-area {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
    }

    .no-print {
        display: none !important;
    }

}
</style>

<div class="flex justify-end items-center gap-3 mb-6 no-print">

    {{-- TEMPLATE SELECTOR --}}
    <form action="{{ route('admin.estimates.changeTemplate', $estimate->id) }}" method="POST">
        @csrf
        <select name="template"
                onchange="this.form.submit()"
                class="border rounded px-3 py-2 text-sm bg-white">
            @foreach(['classic','minimal','blue','corporate','dark','modern','luxury','neon','glass'] as $tpl)
                <option value="{{ $tpl }}" {{ $template == $tpl ? 'selected' : '' }}>
                    {{ ucfirst($tpl) }}
                </option>
            @endforeach
        </select>
    </form>

    {{-- PRINT --}}
    <button onclick="window.print()"
            class="bg-gray-800 text-white px-4 py-2 rounded text-sm hover:bg-black transition">
        🖨 Print
    </button>

    {{-- SEND MAIL --}}
    <form action="{{ route('admin.estimates.send', $estimate->id) }}" method="POST">
        @csrf
        <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded text-sm hover:bg-blue-700 transition">
            📧 Send Mail
        </button>
    </form>

</div>




{{-- ================= LOAD FULL TEMPLATE BLADE ================= --}}
@php
$viewPath = 'admin.estimates.templates.' . $template;

if (!view()->exists($viewPath)) {
    $viewPath = 'admin.estimates.templates.classic';
}
@endphp

<div id="print-area">
    @include($viewPath)
</div>

@endsection
