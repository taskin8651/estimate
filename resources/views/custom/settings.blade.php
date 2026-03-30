@extends('custom.master')
@section('content')
  <div class="page-content-wrapper py-3">
    <div class="container">
      <!-- Setting Card-->
      <div class="card mb-3">
        <div class="card-body">
          <h6 class="mb-2">Settings</h6>

          

          

          <div class="single-setting-panel">
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="rtlSwitch">
              <label class="form-check-label" for="rtlSwitch">RTL Mode</label>
            </div>
          </div>
        </div>
      </div>

      <!-- Setting Card-->
   <div class="card mb-3">
    <div class="card-body">
        <h6 class="mb-3 fw-bold">App Pages</h6>

        <!-- Home -->
        <div class="single-setting-panel">
            <a href="{{ route('home') }}" class="d-flex align-items-center gap-2">
                <div class="icon-wrapper bg-primary">
                    <i class="ti ti-home"></i>
                </div>
                <span>Home</span>
            </a>
        </div>

        <!-- Services -->
        <div class="single-setting-panel">
            <a href="{{ route('services.page') }}" class="d-flex align-items-center gap-2">
                <div class="icon-wrapper bg-success">
                    <i class="ti ti-briefcase"></i>
                </div>
                <span>Services</span>
            </a>
        </div>

        <!-- Gallery -->
        <div class="single-setting-panel">
            <a href="{{ route('gallery.page') }}" class="d-flex align-items-center gap-2">
                <div class="icon-wrapper bg-info">
                    <i class="ti ti-photo"></i>
                </div>
                <span>Gallery</span>
            </a>
        </div>

        <!-- Settings -->
        <div class="single-setting-panel">
            <a href="{{ route('custom.settings') }}" class="d-flex align-items-center gap-2">
                <div class="icon-wrapper bg-warning">
                    <i class="ti ti-settings"></i>
                </div>
                <span>Settings</span>
            </a>
        </div>

        <!-- Privacy Policy -->
        <div class="single-setting-panel">
            <a href="#" class="d-flex align-items-center gap-2">
                <div class="icon-wrapper bg-danger">
                    <i class="ti ti-shield-lock"></i>
                </div>
                <span>Privacy Policy</span>
            </a>
        </div>

    </div>
</div>

     <!-- Setting Card-->
<div class="card">
  <div class="card-body">

    <h6 class="mb-3 fw-bold">Register & Logout</h6>

    <!-- 🔹 Create Account -->
    <div class="single-setting-panel">
      <a href="{{ route('register') }}" class="d-flex align-items-center gap-2">
        <div class="icon-wrapper bg-primary">
          <i class="ti ti-library-plus"></i>
        </div>
        <span>Create New Account</span>
      </a>
    </div>

    <!-- 🔹 Logout -->
    <div class="single-setting-panel">
      <a href="{{ route('logout') }}"
         class="d-flex align-items-center gap-2"
         onclick="event.preventDefault(); document.getElementById('logout-form').submit();">

        <div class="icon-wrapper bg-danger">
          <i class="ti ti-logout"></i>
        </div>
        <span>Logout</span>
      </a>

      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
      </form>
    </div>

    <!-- 🔥 Divider -->
    <hr class="my-3">

    <!-- 🔹 Social Media Section -->
    <h6 class="mb-3 fw-bold">Follow Us</h6>

    <div class="d-flex justify-content-start gap-3">

      <a href="https://www.facebook.com/profile.php?id=61577414950262" target="_blank" class="social-btn fb">
        <i class="ti ti-brand-facebook"></i>
      </a>

      <a href="https://www.instagram.com/msasuite/" target="_blank" class="social-btn insta">
        <i class="ti ti-brand-instagram"></i>
      </a>

      <a href="https://www.linkedin.com/in/msa-suite-2355093bb/" target="_blank" class="social-btn linkedin">
        <i class="ti ti-brand-linkedin"></i>
      </a>

    </div>

  </div>
</div>
<style>
  .social-btn {
  width: 40px;
  height: 40px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 50%;
  color: #fff;
  font-size: 18px;
  transition: 0.3s;
}

.social-btn.fb { background: #1877f2; }
.social-btn.insta { background: #e1306c; }
.social-btn.linkedin { background: #0077b5; }

.social-btn:hover {
  transform: scale(1.1);
  opacity: 0.9;
}
</style>
<script>
  onclick="event.preventDefault(); if(confirm('Logout karna hai?')) document.getElementById('logout-form').submit();"
</script>

    </div>
</div>
    </div>
  </div>
  
  @endsection
  <div class="single-setting-panel">
    <a href="login.html">
      <div class="icon-wrapper bg-danger">
        <i class="ti ti-logout"></i>
      </div>
      Logout
    </a>
  </div>