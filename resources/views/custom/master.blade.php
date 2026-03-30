<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from designing-world.com/affan-v2.0.0/home.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 28 Mar 2026 05:50:42 GMT -->
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Affan - PWA Mobile HTML Template">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

  <meta name="theme-color" content="#0134d4">
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">

  <!-- Title -->
  <title>Affan - PWA Mobile HTML Template</title>

  <!-- Favicon -->
  <!-- Favicon -->
<link rel="icon" href="{{ asset('assets/img/core-img/favicon.ico') }}">

<!-- Apple Touch Icons -->
<link rel="apple-touch-icon" href="{{ asset('assets/img/icons/icon-96x96.png') }}">
<link rel="apple-touch-icon" sizes="152x152" href="{{ asset('assets/img/icons/icon-152x152.png') }}">
<link rel="apple-touch-icon" sizes="167x167" href="{{ asset('assets/img/icons/icon-167x167.png') }}">
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/icons/icon-180x180.png') }}">

<!-- Main CSS -->
<link rel="stylesheet" href="{{ asset('style.css') }}">

<!-- Web App Manifest -->
<link rel="manifest" href="{{ asset('manifest.json') }}">
</head>

<body>
  <!-- Preloader -->
  <div id="preloader">
    <div class="spinner-grow text-primary" role="status">
      <span class="visually-hidden">Loading...</span>
    </div>
  </div>

  <!-- Header Area -->
  <div class="header-area" id="headerArea">
    <div class="container">
      <!-- Header Content -->
      <div class="header-content header-style-five position-relative d-flex align-items-center justify-content-between">
        <!-- Logo Wrapper -->
        <div class="logo-wrapper">
          <a href="{{ route('home') }}">
            <img class="logo-light" src="{{ asset('assets/img/core-img/logoo.png') }}" alt="">
            <img class="logo-dark" src="{{ asset('assets/img/core-img/logoo.png') }}" alt="">
          </a>
        </div>

        <!-- Navbar Toggler -->
        <div class="navbar-toggler" id="affanNavbarToggler" data-bs-toggle="offcanvas" data-bs-target="#affanOffcanvas"
          aria-controls="affanOffcanvas">
          <span class="d-block"></span>
          <span class="d-block"></span>
          <span class="d-block"></span>
        </div>
      </div>
    </div>
  </div>

  <!-- # Sidenav Left -->
  <div class="offcanvas offcanvas-start" id="affanOffcanvas" data-bs-scroll="true" tabindex="-1"
    aria-labelledby="affanOffcanvsLabel">

    <button class="btn-close btn-close-white text-reset" type="button" data-bs-dismiss="offcanvas"
      aria-label="Close"></button>

    <div class="offcanvas-body p-0">
      <div class="sidenav-wrapper">
        <!-- Sidenav Profile -->
        <div class="sidenav-profile bg-gradient">
          <div class="sidenav-style1"></div>

          <!-- User Thumbnail -->
          <div class="user-profile">
            <img src="{{ asset('assets/img/bg-img/user.png') }}" alt="">
          </div>

          <!-- User Info -->
          <div class="user-info">
            <h6 class="user-name mb-0">MSA SUITE</h6>
            <span>Marketing & Software Agency 💼</span>
          </div>
        </div>

        <!-- Sidenav Nav -->
        <ul class="sidenav-nav ps-0">

    <!-- Home -->
    <li class="{{ request()->routeIs('home') ? 'active' : '' }}">
        <a href="{{ route('home') }}">
            <i class="ti ti-smart-home"></i> Home
        </a>
    </li>

    <!-- Gallery -->
    <li class="{{ request()->routeIs('gallery.page') ? 'active' : '' }}">
        <a href="{{ route('gallery.page') }}">
            <i class="ti ti-photo"></i> Gallery
        </a>
    </li>

    <!-- Services -->
    <li class="{{ request()->routeIs('services.*') ? 'active' : '' }}">
        <a href="{{ route('services.page') }}">
            <i class="ti ti-briefcase"></i> Services
        </a>
    </li>

    <!-- Pages -->
    <li class="{{ request()->routeIs('custom.settings') ? 'active' : '' }}">
        <a href="{{ route('custom.settings') }}">
            <i class="ti ti-folders"></i> Pages
        </a>
    </li>

    <!-- Settings -->
    <li class="{{ request()->routeIs('custom.settings') ? 'active' : '' }}">
        <a href="{{ route('custom.settings') }}">
            <i class="ti ti-settings"></i> Settings
        </a>
    </li>

    <!-- Dark Mode -->
    <li>
        <div class="night-mode-nav d-flex align-items-center justify-content-between">
            <div>
                <i class="ti ti-moon"></i> Night Mode
            </div>
            <div class="form-check form-switch m-0">
                <input class="form-check-input form-check-success" id="darkSwitch" type="checkbox">
            </div>
        </div>
    </li>

    <!-- Logout -->
    <li>
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="ti ti-logout"></i> Logout
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
            @csrf
        </form>
    </li>

</ul>

       <div class="mt-auto">
  <!-- Social Info -->
  <div class="social-info-wrap">
    
    <a href="https://www.facebook.com/profile.php?id=61577414950262" target="_blank">
      <i class="ti ti-brand-facebook"></i>
    </a>

    <a href="https://www.instagram.com/msasuite/" target="_blank">
      <i class="ti ti-brand-instagram"></i>
    </a>

    <a href="https://www.linkedin.com/in/msa-suite-2355093bb/" target="_blank">
      <i class="ti ti-brand-linkedin"></i>
    </a>

  </div>

  <!-- Copyright Info -->
  <div class="copyright-info">
    <p>
      <span id="copyrightYear"></span>
      &copy; Made by <a href="#">MSA Suite</a>
    </p>
  </div>
</div>
      </div>
    </div>
  </div>

  @yield('content')



  
  <!-- Footer Nav -->
  <div class="footer-nav-area" id="footerNav">
    <div class="container px-0">
      <!-- Footer Content -->
      <div class="footer-nav position-relative">
        <ul class="h-100 d-flex align-items-center justify-content-between ps-0">
         <li class="{{ request()->routeIs('home') ? 'active' : '' }}">
    <a href="{{ route('home') }}">
        <i class="ti ti-home"></i>
        <span>Home</span>
    </a>
</li>

<li class="{{ request()->routeIs('gallery.page') ? 'active' : '' }}">
    <a href="{{ route('gallery.page') }}">
        <i class="ti ti-photo"></i>
        <span>Gallery</span>
    </a>
</li>

<li class="{{ request()->routeIs('services.page') || request()->routeIs('services.show') ? 'active' : '' }}">
    <a href="{{ route('services.page') }}">
        <i class="ti ti-briefcase"></i>
        <span>Services</span>
    </a>
</li>

<li class="{{ request()->routeIs('custom.settings') ? 'active' : '' }}">
    <a href="{{ route('custom.settings') }}">
        <i class="ti ti-settings"></i>
        <span>Settings</span>
    </a>
</li>
        </ul>
      </div>
    </div>
  </div>

  <!-- All JavaScript Files -->
  <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/slideToggle.min.js') }}"></script>
<script src="{{ asset('assets/js/internet-status.js') }}"></script>
<script src="{{ asset('assets/js/tiny-slider.js') }}"></script>
<script src="{{ asset('assets/js/venobox.min.js') }}"></script>
<script src="{{ asset('assets/js/countdown.js') }}"></script>
<script src="{{ asset('assets/js/rangeslider.min.js') }}"></script>
<script src="{{ asset('assets/js/vanilla-dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/index.js') }}"></script>
<script src="{{ asset('assets/js/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/js/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/js/nice-select2.js') }}"></script>
<script src="{{ asset('assets/js/dark-rtl.js') }}"></script>
<script src="{{ asset('assets/js/active.js') }}"></script>
<script src="{{ asset('assets/js/pwa.js') }}"></script>
</body>


<!-- Mirrored from designing-world.com/affan-v2.0.0/home.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 28 Mar 2026 05:51:11 GMT -->
</html>