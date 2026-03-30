@extends('custom.master')
@section('content')

<div class="login-wrapper d-flex align-items-center justify-content-center">
    <div class="custom-container">

        <!-- Image -->
        <div class="text-center px-4">
            <img class="login-intro-img" src="{{ asset('assets/img/bg-img/36.png') }}" alt="">
        </div>

        <!-- Login Form -->
        <div class="register-form mt-4">
            <h2 class="mb-3 text-center">Demo Login</h2>

            <div class="alert alert-warning text-center">
                Use demo credentials below 👇
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email (UI only) -->
                <div class="form-group">
                    <input class="form-control"
                           type="email"
                           value="demo@msasuite.in"
                           disabled>
                </div>

                <!-- Password (UI only with toggle) -->
                <div class="form-group position-relative">
                    <input class="form-control"
                           id="fake-password"
                           type="password"
                           value="12345678"
                           disabled>

                    <!-- Toggle -->
                    <div id="password-visibility"
                         style="position:absolute; right:10px; top:50%; transform:translateY(-50%); cursor:pointer;">
                        <i class="ti ti-eye"></i>
                    </div>
                </div>

                <!-- Hidden real values -->
                <input type="hidden" name="email" value="demo@msasuite.in">
                <input type="hidden" name="password" value="12345678">

                <!-- Remember -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <label class="d-flex align-items-center gap-2">
                        <input type="checkbox" name="remember" checked>
                        <span>Remember Me</span>
                    </label>
                </div>

                <!-- Button -->
                <button class="btn btn-primary w-100" type="submit">
                    Login Demo <i class="ti ti-arrow-right"></i>
                </button>
            </form>
        </div>

        <!-- Bottom -->
        <div class="text-center mt-3">
            <small class="text-muted">
                Demo Access Only – Data may reset anytime
            </small>
        </div>

    </div>
</div>

<!-- Password Toggle -->
<script>
document.getElementById('password-visibility').addEventListener('click', function () {
    let input = document.getElementById('fake-password');
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