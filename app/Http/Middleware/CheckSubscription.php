<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CheckSubscription
{
    public function handle(Request $request, Closure $next)
    {
        // Guest users allow
        if (!auth()->check()) {
            return $next($request);
        }

        $user = auth()->user();

      

        // Billing routes allow
        if ($request->routeIs('billing.*')) {
            return $next($request);
        }

        // Expiry check
        if ($user->subscription_ends_at) {

            $subscriptionEnd = Carbon::parse($user->subscription_ends_at);

           

            if (now()->gt($subscriptionEnd)) {
                return redirect()->route('billing.index')
                    ->with('error', 'Your subscription has expired.');
            }
        }

        return $next($request);
    }
}