@extends('custom.master')
@section('content')

<div class="page-content-wrapper py-3">
    <div class="container">

        <!-- 🔹 USER INFO -->
        <div class="card user-info-card mb-3">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="user-profile position-relative">
                    <img src="{{ asset('assets/img/bg-img/2.jpg') }}" alt="">
                    
                    <form action="{{ route('profile.password.updateProfile') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label class="position-absolute top-0 end-0">
                            <i class="ti ti-pencil"></i>
                            <input type="file" name="avatar" hidden onchange="this.form.submit()">
                        </label>
                    </form>
                </div>

                <div class="user-info">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-1">{{ auth()->user()->name }}</h5>

                        @if(auth()->user()->subscription_status == 'active')
                            <span class="badge text-bg-success ms-2 rounded-pill">Active</span>
                        @else
                            <span class="badge text-bg-warning ms-2 rounded-pill">Trial</span>
                        @endif
                    </div>

                    <p class="mb-0">{{ auth()->user()->email }}</p>
                </div>
            </div>
        </div>

        <!-- 🔹 PROFILE UPDATE -->
        <div class="card user-data-card mb-3">
            <div class="card-body">
                <form method="POST" action="{{ route('profile.password.updateProfile') }}">
                    @csrf

                    <div class="form-group mb-3">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control"
                               value="{{ old('name', auth()->user()->name) }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control"
                               value="{{ old('email', auth()->user()->email) }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Company Name</label>
                        <input type="text" name="company_name" class="form-control"
                               value="{{ old('company_name', auth()->user()->company_name) }}">
                    </div>

                    <button class="btn btn-primary w-100">
                        Update Profile <i class="ti ti-refresh"></i>
                    </button>
                </form>
            </div>
        </div>

        <!-- 🔹 CHANGE PASSWORD -->
        <div class="card mb-3">
            <div class="card-body">
                <form method="POST" action="{{ route('profile.password.update') }}">
                    @csrf

                    <div class="form-group mb-3">
                        <label>New Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>

                    <button class="btn btn-warning w-100">
                        Change Password
                    </button>
                </form>
            </div>
        </div>

        <!-- 🔹 DELETE ACCOUNT -->
        <div class="card">
            <div class="card-body">
                <form method="POST"
                      action="{{ route('profile.password.destroyProfile') }}"
                      onsubmit="return confirm('Are you sure? Type your email to confirm')">
                    @csrf

                    <button class="btn btn-danger w-100">
                        Delete Account
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>

@endsection