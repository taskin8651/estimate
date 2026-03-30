@extends('custom.master')

@section('content')

<div class="page-content-wrapper py-3">
  <div class="blog-wrapper">
    <div class="container">
      <div class="row g-3">

        @foreach($services as $service)
        <div class="col-6">
          <div class="card position-relative h-100">

            <!-- Image -->
            <img class="card-img-top"
                 src="{{ $service->icon ? asset('storage/'.$service->icon) : asset('assets/img/default.png') }}"
                 alt="{{ $service->name }}">

            <!-- Badge -->
            <span class="badge text-bg-warning position-absolute card-badge">
              Service
            </span>

            <div class="card-body d-flex flex-column">

              <!-- Price -->
              <span class="badge bg-danger rounded-pill mb-2 d-inline-block">
                ₹{{ $service->base_price ?? 'Custom' }}
              </span>

              <!-- Title -->
              <a class="blog-title d-block mb-2 text-dark"
                 href="{{ route('services.show', $service->slug) }}">
                {{ $service->name }}
              </a>

              <!-- Description -->
              <p class="text-muted small">
                {{ \Illuminate\Support\Str::limit($service->description, 60) }}
              </p>

              <!-- Button -->
              <a class="btn btn-primary btn-sm mt-auto"
                 href="{{ route('services.show', $service->slug) }}">
                Get Estimate
              </a>

            </div>
          </div>
        </div>
        @endforeach

      </div>
    </div>
  </div>
</div>

@endsection