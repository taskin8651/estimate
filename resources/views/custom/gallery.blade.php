@extends('custom.master')

@section('content')

<div class="container mt-5">
  <div class="card">
    <div class="card-body">

      <div class="row g-3">

        @foreach($galleries as $item)
        <div class="col-6">
          <div class="single-gallery-item">

            <!-- Dynamic Image -->
            <img src="{{ $item->getFirstMediaUrl('gallery') }}"
                 alt="{{ $item->title }}">

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

@endsection