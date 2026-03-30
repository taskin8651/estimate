@extends('custom.master')

@section('content')
<div class="page-content-wrapper py-3">

<div class="container py-4">


    <img src="{{ asset('storage/'.$service->icon) }}"
         class="img-fluid mb-3">
             <h2>{{ $service->name }}</h2>


    <h4>Price: ₹{{ $service->base_price ?? 'Custom' }}</h4>

    <p>{{ $service->description }}</p>

</div>
</div>

@endsection