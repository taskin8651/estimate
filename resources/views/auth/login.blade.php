@extends('custom.master')
@section('content')

<!-- Login Wrapper Area -->
<div class="login-wrapper d-flex align-items-center justify-content-center">
    <div class="custom-container">

        <!-- Image -->
        <div class="text-center px-4">
            <img class="login-intro-img" src="{{ asset('assets/img/bg-img/36.png') }}" alt="">
        </div>

        <!-- Login Form -->
        <div class="register-form mt-4">
            <h2 class="mb-3 text-center">{{ trans('global.login') }}</h2>

            @if(session('message'))
                <div class="alert alert-info text-center">
                    {{ session('message') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="form-group">
                    <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                           type="email"
                           name="email"
                           value="{{ old('email') }}"
                           placeholder="{{ trans('global.login_email') }}"
                           required autofocus>

                    @if($errors->has('email'))
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                </div>

                <!-- Password -->
                <div class="form-group position-relative">
                    <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                           id="password"
                           type="password"
                           name="password"
                           placeholder="{{ trans('global.login_password') }}"
                           required>

                    <!-- Toggle -->
                    <div class="position-absolute" id="password-visibility" style="right: 10px; top: 50%; transform: translateY(-50%); cursor:pointer;">
                        <i class="ti ti-eye"></i>
                    </div>

                    @if($errors->has('password'))
                        <div class="invalid-feedback">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                </div>

                <!-- Remember -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <label class="d-flex align-items-center gap-2">
                        <input type="checkbox" name="remember">
                        <span>{{ trans('global.remember_me') }}</span>
                    </label>

                    @if(Route::has('password.request'))
                        <a href="{{ route('password.request') }}">
                            {{ trans('global.forgot_password') }}
                        </a>
                    @endif
                </div>

                <!-- Button -->
                <button class="btn btn-primary w-100" type="submit">
                    {{ trans('global.login') }} <i class="ti ti-arrow-right"></i>
                </button>
            </form>
        </div>

        <!-- Bottom Links -->
        <div class="login-meta-data text-center">
            @if(Route::has('password.request'))
                <a class="d-block mt-3 mb-1" href="{{ route('password.request') }}">
                    {{ trans('global.forgot_password') }}
                </a>
            @endif

            <p class="mb-0">
                {{ __("Don't have an account?") }}
                <a href="{{ route('register') }}">
                    {{ trans('global.register') }}
                </a>
            </p>
        </div>

    </div>
</div>

<!-- 🔥 Password Toggle Script -->
<script>
    document.getElementById('password-visibility').addEventListener('click', function () {
        let input = document.getElementById('password');
        let icon = this.querySelector('i');

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('ti-eye');
            icon.classList.add('ti-eye-off');
        } else {
            input.type = 'password';
            icon.classList.remove('ti-eye-off');
            icon.classList.add('ti-eye');
        }
    });
</script>

@endsection