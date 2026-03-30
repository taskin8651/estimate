@extends('custom.master')

@section('content')

<div class="page-content-wrapper">
 <!-- Welcome Toast -->
    <div class="toast toast-autohide custom-toast-1 home-page-toast shadow" role="alert" aria-live="assertive"
      aria-atomic="true" data-bs-delay="60000" data-bs-autohide="true" id="installWrap">
      <div class="toast-body p-0">
        <div class="toast-text">
          <h6 class="mb-1">Welcome to Affan!</h6>
          <span class="d-block mb-2">Click the <strong class="text-primary">Install Now</strong> button & enjoy it just
            like an
            app.</span>
          <button id="installAffan" class="btn btn-sm btn-warning">Install Now</button>
        </div>
      </div>
      <button class="btn btn-close position-relative p-2" type="button" data-bs-dismiss="toast"
        aria-label="Close"></button>
    </div>

    <!-- Tiny Slider One Wrapper -->
 <div class="tiny-slider-one-wrapper" dir="ltr">
  <div class="tiny-slider-one">

    @foreach($heroes as $hero)
    <div>
      <div class="single-hero-slide bg-overlay" 
           style="background-image: url('{{ $hero->image_url }}')">

        <div class="h-100 d-flex align-items-center text-center">
          <div class="container">

            <h3 class="text-white mb-1">
              {{ $hero->title }}
            </h3>

            <p class="text-white">
              {{ $hero->subtitle }}
            </p>

            @if($hero->button_text)
            <a class="btn btn-creative btn-warning" 
               href="{{ $hero->button_link ?? '#' }}">
               
               {{ $hero->button_text }}
               <i class="ti ti-arrow-right"></i>
            </a>
            @endif

          </div>
        </div>

      </div>
    </div>
    @endforeach

  </div>
</div>

 <div class="pt-3"></div>

   <div class="container">
  <div class="card mb-3">
    <div class="py-3 text-center">
  <h5 class="fw-bold mb-1">✨ Try Powerful Tools Instantly</h5>
  <p class="text-muted small mb-0">
    Build websites, create estimates & send bulk emails — all in one place
  </p>
</div>
    <div class="card-body">
      <div class="row g-3">

        <!-- Build Website -->
        <div class="col-4">
          <a href="/build-website" class="text-decoration-none">
            <div class="feature-card mx-auto text-center">
              <div class="card mx-auto bg-gray p-3">
                <i class="ti ti-world fs-2"></i>
              </div>
              <h6 class="mb-0 fz-14 mt-2 text-dark">Build Website</h6>
            </div>
          </a>
        </div>

        <!-- Estimate -->
        <div class="col-4">
          <a href="/demo-estimate" class="text-decoration-none">
            <div class="feature-card mx-auto text-center">
              <div class="card mx-auto bg-gray p-3">
                <i class="ti ti-calculator fs-2"></i>
              </div>
              <h6 class="mb-0 fz-14 mt-2 text-dark">Estimate</h6>
            </div>
          </a>
        </div>

        <!-- Bulk Email -->
        <div class="col-4">
          <a href="/bulk-email" class="text-decoration-none">
            <div class="feature-card mx-auto text-center">
              <div class="card mx-auto bg-gray p-3">
                <i class="ti ti-mail fs-2"></i>
              </div>
              <h6 class="mb-0 fz-14 mt-2 text-dark">Bulk Email</h6>
            </div>
          </a>
        </div>

      </div>
    </div>
  </div>
</div>

  <div class="page-content-wrapper py-3">
  <div class="blog-wrapper">
    <div class="container">
      <div class="row g-3">

        @foreach($services as $service)
        <div class="col-6">
          <div class="card position-relative">

            <!-- Image -->
            <img class="card-img-top" 
                 src="{{ $service->icon ? asset('storage/'.$service->icon) : asset('assets/img/default.png') }}" 
                 alt="{{ $service->name }}">

            <!-- Badge -->
            <span class="badge text-bg-warning position-absolute card-badge">
              Service
            </span>

            <div class="card-body">

              <!-- Price -->
              <span class="badge bg-danger rounded-pill mb-2 d-inline-block">
                ₹{{ $service->base_price ?? 'Custom' }}
              </span>

              <!-- Title -->
              <a class="blog-title d-block mb-2 text-dark" href="#">
                {{ $service->name }}
              </a>

              <!-- Description -->
              <p class="text-muted small">
                {{ Str::limit($service->description, 60) }}
              </p>

              <!-- Button -->
              <a class="btn btn-primary btn-sm" href="#">
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
    

  
<div class="page-content-wrapper py-3">

  <div class="container">
    <div class="card">
      <div class="card-body">

        <div class="price-table-one">

          <!-- Tabs -->
          <ul class="nav nav-tabs border-bottom-0 mb-3 align-items-center justify-content-center" role="tablist">

            @foreach($plans as $key => $plan)
            <li class="nav-item" role="presentation">
              <a class="nav-link {{ $key == 1 ? 'active' : '' }} shadow"
                 data-bs-toggle="tab"
                 href="#plan_{{ $plan->id }}"
                 role="tab">

                @if($plan->type == 'intro')
                  <i class="ti ti-seedling"></i>
                @elseif($plan->type == 'popular')
                  <i class="ti ti-plant"></i>
                @else
                  <i class="ti ti-building"></i>
                @endif

              </a>
            </li>
            @endforeach

          </ul>

          <!-- Content -->
          <div class="tab-content">

            @foreach($plans as $key => $plan)
            <div class="tab-pane fade {{ $key == 1 ? 'show active' : '' }}"
                 id="plan_{{ $plan->id }}"
                 role="tabpanel">

              <div class="single-price-content">

                <!-- PRICE -->
                <div class="price text-center">

                  <span class="text-white mb-2 d-block">
                    {{ ucfirst($plan->type) }}
                  </span>

                  <h2 class="display-3">
                    ₹{{ number_format($plan->price) }}
                  </h2>

                  <span class="badge bg-light text-dark rounded-pill">
                    {{ $plan->duration }}
                  </span>

                  @if($plan->type == 'popular')
                  <div class="mt-2">
                    <span class="badge bg-warning text-dark">
                      🔥 Most Popular
                    </span>
                  </div>
                  @endif

                </div>

                <!-- FEATURES -->
                <div class="pricing-desc mt-3">
                  <ul class="ps-0 list-unstyled">

                    @foreach($plan->features ?? [] as $feature)
                      <li class="mb-2">
                        <i class="ti ti-check text-success"></i>
                        {{ $feature }}
                      </li>
                    @endforeach

                  </ul>
                </div>

                <!-- BUTTON -->
                <div class="purchase mt-4">

                  <a class="btn btn-lg btn-creative w-100
                    {{ $plan->type == 'popular' ? 'btn-warning' : 'btn-primary' }}"
                     href="#">

                    Choose Plan
                    <i class="ti ti-arrow-right"></i>

                  </a>

                  <small class="d-block text-white mt-2 text-center">
                    No hidden charges
                  </small>

                </div>

              </div>

            </div>
            @endforeach

          </div>

        </div>

      </div>
    </div>
  </div>

</div>

 

 <div class="container mt-3">
  <div class="card">
    <div class="card-body">

      <div class="d-flex align-items-end justify-content-between gap-3 mb-3">
        <div class="image-gallery-text">
          <h3 class="mb-0">Recent works</h3>
          <p class="mb-0">Latest awesome portfolio.</p>
        </div>

        <div>
          <a class="btn btn-primary btn-sm" href="#">View More</a>
        </div>
      </div>

      <!-- Gallery Slider -->
      <div class="image-gallery-slides-wrapper" dir="ltr">
        <div class="image-gallery-carousel">

          @foreach($galleries as $item)
          <div>
            <div class="single-gallery-item">

              <!-- Image -->
              <img src="{{ $item->getFirstMediaUrl('gallery') }}" alt="{{ $item->title }}">

              <!-- Fav Icon -->
              <a class="fav-icon shadow" href="#">
                <i class="ti ti-heart"></i>
              </a>

            </div>
          </div>
          @endforeach

        </div>
      </div>

    </div>
  </div>
</div>


<div class="container">
  <div class="card">
    <div class="card-body p-0">

      <div class="testimonial-slide-two-wrapper" dir="ltr">
        <div class="testimonial-slide2 testimonial-style2">

          @foreach($testimonials as $testimonial)
          <div class="single-testimonial-slide">

            <!-- Image -->
            <div class="image-wrapper">
              <img src="{{ $testimonial->image_url }}" alt="{{ $testimonial->name }}">
              <i class="ti ti-quote"></i>
            </div>

            <!-- Content -->
            <div class="text-content text-center p-3">

              <h6 class="mb-1 fw-bold">
                {{ $testimonial->name }}
              </h6>

              <p class="mb-2 text-muted small">
                {{ $testimonial->message }}
              </p>

              <!-- Rating -->
              <div class="text-warning">
                @for($i = 1; $i <= 5; $i++)
                  {{ $i <= $testimonial->rating ? '★' : '☆' }}
                @endfor
              </div>

            </div>

          </div>
          @endforeach

        </div>
      </div>

    </div>
  </div>
</div>



       <div class="container">
      <div class="container">
  <div class="card bg-info">
    <div class="card-body">

      <div class="partner-logo-slide-wrapper-2" dir="ltr">
        <div class="partner-slide2">

          @foreach($brands as $brand)
          <div>
            <div class="card partner-slide-card border my-2 bg-white">
              <div class="card-body text-center">

                <a href="#">
                  <img src="{{ $brand->logo_url }}" 
                       alt="{{ $brand->name }}" 
                       class="img-fluid"
                       style="max-height:50px;">
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
    </div>





</div>


@endsection