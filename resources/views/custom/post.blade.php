@extends('custom.master')

@section('content')

<div class="page-content-wrapper py-3">

  <!-- Header -->
  <div class="container mb-3">
    <h4 class="fw-bold">Our Projects</h4>
  </div>

  <!-- Posts List -->
  <div class="top-products-area product-list-wrap">
    <div class="container">
      <div class="row g-3">

        @forelse($posts as $post)

        <div class="col-12">
          <div class="card single-product-card shadow-sm">
            <div class="card-body">
              <div class="d-flex align-items-center">

                <!-- Image -->
                <div class="card-side-img">
                  <a class="product-thumbnail d-block"
                     href="{{ route('post.details',$post->slug) }}">

                    @if($post->getFirstMediaUrl('images'))
                      <img src="{{ $post->getFirstMediaUrl('images') }}" alt="">
                    @else
                      <img src="https://via.placeholder.com/100x100" alt="">
                    @endif

                    <span class="badge bg-primary">New</span>
                  </a>
                </div>

                <!-- Content -->
                <div class="card-content px-4 py-2">

                  <!-- Title -->
                  <a class="product-title d-block text-truncate mt-0 fw-bold"
                     href="{{ route('post.details',$post->slug) }}">
                    {{ $post->title }}
                  </a>

                  <!-- Short Description -->
                  <p class="text-muted mb-2">
                    {{ \Illuminate\Support\Str::limit(strip_tags($post->content), 80) }}
                  </p>

                  <!-- Button -->
                  <a class="btn btn-primary btn-sm"
                     href="{{ route('post.details',$post->slug) }}">
                    Read More
                  </a>

                </div>

              </div>
            </div>
          </div>
        </div>

        @empty

        <div class="col-12 text-center">
          <p>No Posts Found</p>
        </div>

        @endforelse

      </div>
    </div>
  </div>

</div>

@endsection