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
        <div class="card single-product-card">
          <div class="card-body">

            <!-- 👇 Mobile: column | Desktop: row -->
            <div class="d-flex flex-column flex-sm-row align-items-start">

              <!-- 🖼️ Image -->
              <div class="card-side-img mb-2 mb-sm-0 me-sm-3">
                <a class="product-thumbnail d-block"
                   href="{{ route('post.details',$post->slug) }}">

                 @if($post->getFirstMediaUrl('images'))
    <img src="{{ $post->getFirstMediaUrl('images') }}"
         class="img-fluid rounded"
         style="width:100%; max-height:auto; height:none !important;  background:#f8f9fa;">
@else
    <img src="https://via.placeholder.com/300x200"
         class="img-fluid rounded"
         style="width:100%; height:200px;  background:#f8f9fa;">
@endif

<style>
  .card-side-img img {
    width: 100%;
    height: auto;
    max-height: none !important;
}
</style>

                  <span class="badge bg-primary">New</span>
                </a>
              </div>

              <!-- 📄 Content -->
              <div class="card-content flex-grow-1">

                <!-- Title -->
                <a class="product-title d-block fw-bold mb-1"
                   href="{{ route('post.details',$post->slug) }}">
                  {{ $post->title }}
                </a>

                <!-- Description -->
                <p class="text-muted small mb-2">
                  {{ \Illuminate\Support\Str::limit(strip_tags($post->content), 70) }}
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