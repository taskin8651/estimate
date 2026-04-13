@extends('custom.master')

@section('content')

<div class="page-content-wrapper py-3">
  <div class="container">

    <!-- 🖼️ IMAGE GALLERY -->
    <div class="card product-details-card mb-3">
      <span class="badge text-bg-warning position-absolute product-badge">New</span>

      <div class="card-body">
        <div class="product-gallery-wrapper" dir="ltr">
          <div class="product-gallery gallery-img">

            @forelse($post->getMedia('images') as $img)
              <a href="{{ $img->getUrl() }}" class="image-zooming-in-out">
                <img class="rounded" src="{{ $img->getUrl() }}" alt="">
              </a>
            @empty
              <img src="https://via.placeholder.com/300" class="rounded">
            @endforelse

          </div>
        </div>
      </div>
    </div>

    <!-- 📌 POST TITLE + SHORT -->
    <div class="card product-details-card mb-3">
      <div class="card-body">

        <h3 class="fw-bold">{{ $post->title }}</h3>

        <p class="text-muted">
             {!! $post->content !!}
        </p>

       

      </div>
    </div>

   

    <!-- 🔥 RELATED POSTS (OPTIONAL) -->
    <div class="card related-product-card">
      <div class="card-body">

        <h5 class="mb-3">Related Posts</h5>

        <div class="row g-3">

         @foreach(\App\Models\Post::where('id','!=',$post->id)->latest()->take(4)->get() as $item)
<div class="col-6 col-sm-4 col-lg-3">
  <div class="card single-product-card border">
    <div class="card-body p-2">

      <a class="product-thumbnail d-block"
         href="{{ route('post.details',$item->slug) }}">

        <img src="{{ $item->getFirstMediaUrl('images') ?: 'https://via.placeholder.com/150' }}">
        <span class="badge bg-primary">New</span>
      </a>

      <a class="product-title d-block text-truncate"
         href="{{ route('post.details',$item->slug) }}">
         {{ $item->title }}
      </a>

    </div>
  </div>
</div>
@endforeach

        </div>

      </div>
    </div>

  </div>
</div>

@endsection