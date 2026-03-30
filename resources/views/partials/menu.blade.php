<aside
    x-cloak
    class="fixed inset-y-0 left-0 z-50 w-64 bg-slate-900 text-slate-100 flex flex-col
           transform transition-transform duration-300 ease-in-out
           -translate-x-full lg:translate-x-0 lg:static"
    :class="sidebarOpen ? 'translate-x-0' : ''">


    {{-- BRAND --}}
    <div class="px-6 py-4 text-xl font-semibold border-b border-slate-700
                tracking-wide">
        {{ trans('panel.site_title') }}
    </div>

    {{-- NAV --}}
    <nav class="flex-1 px-3 py-4 space-y-1 text-sm">

        {{-- DASHBOARD --}}
        <a href="{{ route('admin.home') }}"
           class="group flex items-center gap-3 px-3 py-2 rounded transition
           {{ request()->routeIs('admin.home')
                ? 'bg-slate-800 text-white'
                : 'hover:bg-slate-800 hover:pl-4' }}">
            <i class="fas fa-tachometer-alt text-slate-400 group-hover:text-white transition"></i>
            {{ trans('global.dashboard') }}
        </a>

        {{-- USER MANAGEMENT --}}
        @can('user_management_access')
            <div x-data="{ open:
                {{ request()->is('admin/permissions*')
                || request()->is('admin/roles*')
                || request()->is('admin/users*')
                || request()->is('admin/audit-logs*') ? 'true' : 'false' }}
            }">

                <button @click="open = !open"
                        class="group w-full flex items-center justify-between px-3 py-2 rounded
                               hover:bg-slate-800 transition">
                    <span class="flex items-center gap-3">
                        <i class="fas fa-users text-slate-400 group-hover:text-white transition"></i>
                        {{ trans('cruds.userManagement.title') }}
                    </span>

                    <i class="fas fa-chevron-down text-xs transition-transform duration-300"
                       :class="open ? 'rotate-180' : ''"></i>
                </button>

                {{-- DROPDOWN --}}
                <div x-show="open"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 -translate-y-2"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 translate-y-0"
                     x-transition:leave-end="opacity-0 -translate-y-2"
                     class="ml-6 mt-1 space-y-1">

                    @can('permission_access')
                        <a href="{{ route('admin.permissions.index') }}"
                           class="block px-3 py-2 rounded transition
                           {{ request()->is('admin/permissions*')
                                ? 'bg-slate-800 text-white'
                                : 'hover:bg-slate-800 hover:pl-4' }}">
                            {{ trans('cruds.permission.title') }}
                        </a>
                    @endcan

                    @can('role_access')
                        <a href="{{ route('admin.roles.index') }}"
                           class="block px-3 py-2 rounded transition
                           {{ request()->is('admin/roles*')
                                ? 'bg-slate-800 text-white'
                                : 'hover:bg-slate-800 hover:pl-4' }}">
                            {{ trans('cruds.role.title') }}
                        </a>
                    @endcan

                    @can('user_access')
                        <a href="{{ route('admin.users.index') }}"
                           class="block px-3 py-2 rounded transition
                           {{ request()->is('admin/users*')
                                ? 'bg-slate-800 text-white'
                                : 'hover:bg-slate-800 hover:pl-4' }}">
                            {{ trans('cruds.user.title') }}
                        </a>
                    @endcan

                    @can('audit_log_access')
                        <a href="{{ route('admin.audit-logs.index') }}"
                           class="block px-3 py-2 rounded transition
                           {{ request()->is('admin/audit-logs*')
                                ? 'bg-slate-800 text-white'
                                : 'hover:bg-slate-800 hover:pl-4' }}">
                            {{ trans('cruds.auditLog.title') }}
                        </a>
                    @endcan

                </div>
            </div>
        @endcan

     {{-- ================= FINANCE MENU ================= --}}
@canany(['client_access','estimate_access','tax_access'])
<div x-data="{ 
        open: {{ request()->is('admin/clients*') || request()->is('admin/estimates*') || request()->is('admin/tax*') ? 'true' : 'false' }} 
    }">

    <button @click="open = !open"
            class="group w-full flex items-center justify-between px-3 py-2 rounded transition
                   hover:bg-slate-800
                   {{ request()->is('admin/clients*') || request()->is('admin/estimates*') || request()->is('admin/tax*')
                        ? 'bg-slate-800 text-white'
                        : '' }}">
        <span class="flex items-center gap-3">
            <i class="fas fa-briefcase text-slate-400 group-hover:text-white transition"></i>
            Finance
        </span>

        <i class="fas fa-chevron-down text-xs transition-transform duration-300"
           :class="open ? 'rotate-180' : ''"></i>
    </button>

    {{-- Dropdown --}}
    <div x-show="open"
         x-transition
         class="ml-6 mt-1 space-y-1">

        {{-- Clients --}}
        @can('client_access')
            <a href="{{ route('admin.clients.index') }}"
               class="block px-3 py-2 rounded transition
               {{ request()->is('admin/clients*')
                    ? 'bg-slate-800 text-white'
                    : 'hover:bg-slate-800 hover:pl-4' }}">
                Clients
            </a>
        @endcan


        {{-- Estimates --}}
        @can('estimate_access')
            <a href="{{ route('admin.estimates.index') }}"
               class="block px-3 py-2 rounded transition
               {{ request()->is('admin/estimates*')
                    ? 'bg-slate-800 text-white'
                    : 'hover:bg-slate-800 hover:pl-4' }}">
                Estimates
            </a>
        @endcan


        {{-- Taxes --}}
        @can('tax_access')
            <a href="{{ route('admin.tax.index') }}"
               class="block px-3 py-2 rounded transition
               {{ request()->is('admin/tax*')
                    ? 'bg-slate-800 text-white'
                    : 'hover:bg-slate-800 hover:pl-4' }}">
                Taxes
            </a>
        @endcan

    </div>
</div>
@endcanany




{{-- ================= SETTINGS ================= --}}
@can('setting_access')
<a href="{{ route('admin.settings.index') }}"
   class="group flex items-center gap-3 px-3 py-2 rounded transition
   {{ request()->is('admin/settings*')
        ? 'bg-slate-800 text-white'
        : 'hover:bg-slate-800 hover:pl-4' }}">
    <i class="fas fa-cog text-slate-400 group-hover:text-white transition"></i>
    Settings
</a>
@endcan


{{-- ================= CMS MENU ================= --}}
@canany(['hero_access','service_access','pricing_access','testimonial_access','brand_access','gallery_access'])
<div x-data="{ 
        open: {{ request()->is('admin/hero*') || request()->is('admin/services*') || request()->is('admin/pricing*') || request()->is('admin/testimonials*') || request()->is('admin/brands*') || request()->is('admin/gallery*') ? 'true' : 'false' }} 
    }">

    <button @click="open = !open"
            class="group w-full flex items-center justify-between px-3 py-2 rounded transition
                   hover:bg-slate-800
                   {{ request()->is('admin/hero*') || request()->is('admin/services*') || request()->is('admin/pricing*') || request()->is('admin/testimonials*') || request()->is('admin/brands*')
                        ? 'bg-slate-800 text-white'
                        : '' }}">

        <span class="flex items-center gap-3">
            <i class="fas fa-layer-group text-slate-400 group-hover:text-white transition"></i>
            CMS
        </span>

        <i class="fas fa-chevron-down text-xs transition-transform duration-300"
           :class="open ? 'rotate-180' : ''"></i>
    </button>

    {{-- Dropdown --}}
    <div x-show="open"
         x-transition
         class="ml-6 mt-1 space-y-1">

        {{-- Hero --}}
        @can('hero_access')
            <a href="{{ route('admin.hero.index') }}"
               class="block px-3 py-2 rounded transition
               {{ request()->is('admin/hero*')
                    ? 'bg-slate-800 text-white'
                    : 'hover:bg-slate-800 hover:pl-4' }}">
                Hero Section
            </a>
        @endcan

        {{-- Services --}}
        @can('service_access')
            <a href="{{ route('admin.services.index') }}"
               class="block px-3 py-2 rounded transition
               {{ request()->is('admin/services*')
                    ? 'bg-slate-800 text-white'
                    : 'hover:bg-slate-800 hover:pl-4' }}">
                Services
            </a>
        @endcan

        {{-- Pricing --}}
        @can('pricing_access')
            <a href="{{ route('admin.pricing.index') }}"
               class="block px-3 py-2 rounded transition
               {{ request()->is('admin/pricing*')
                    ? 'bg-slate-800 text-white'
                    : 'hover:bg-slate-800 hover:pl-4' }}">
                Pricing
            </a>
        @endcan

        {{-- Testimonials --}}
        @can('testimonial_access')
            <a href="{{ route('admin.testimonials.index') }}"
               class="block px-3 py-2 rounded transition
               {{ request()->is('admin/testimonials*')
                    ? 'bg-slate-800 text-white'
                    : 'hover:bg-slate-800 hover:pl-4' }}">
                Testimonials
            </a>
        @endcan

        {{-- Brands --}}
        @can('brand_access')
            <a href="{{ route('admin.brands.index') }}"
               class="block px-3 py-2 rounded transition
               {{ request()->is('admin/brands*')
                    ? 'bg-slate-800 text-white'
                    : 'hover:bg-slate-800 hover:pl-4' }}">
                Brands
            </a>
        @endcan

        {{-- Gallery --}}
        @can('gallery_access')
            <a href="{{ route('admin.gallery.index') }}"
               class="block px-3 py-2 rounded transition
               {{ request()->is('admin/gallery*')
                    ? 'bg-slate-800 text-white'
                    : 'hover:bg-slate-800 hover:pl-4' }}">
                Gallery
            </a>
        @endcan

    </div>
</div>
@endcanany



        {{-- CHANGE PASSWORD --}}
        @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
            @can('profile_password_edit')
                <a href="{{ route('profile.password.edit') }}"
                   class="group flex items-center gap-3 px-3 py-2 rounded transition
                   {{ request()->is('profile/password*')
                        ? 'bg-slate-800 text-white'
                        : 'hover:bg-slate-800 hover:pl-4' }}">
                    <i class="fas fa-key text-slate-400 group-hover:text-white transition"></i>
                    {{ trans('global.change_password') }}
                </a>
            @endcan
        @endif

    </nav>

    {{-- LOGOUT --}}
    <div class="border-t border-slate-700 p-3">
        <a href="#"
           onclick="event.preventDefault(); document.getElementById('logoutform').submit();"
           class="group flex items-center gap-3 px-3 py-2 rounded transition
                  hover:bg-red-600 hover:text-white">
            <i class="fas fa-sign-out-alt transition group-hover:translate-x-1"></i>
            {{ trans('global.logout') }}
        </a>
    </div>

</aside>
