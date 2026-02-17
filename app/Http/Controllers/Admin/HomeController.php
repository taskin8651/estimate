<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Estimate;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->is_admin) {
            return $this->adminDashboard();
        }

        return $this->userDashboard($user);
    }

    /*
    |--------------------------------------------------------------------------
    | 👑 ADMIN DASHBOARD
    |--------------------------------------------------------------------------
    */
    private function adminDashboard()
    {
        $year = date('Y');

        // Base Query
        $estimateQuery = Estimate::query();

        // ===== Stats =====
        $totalUsers     = User::count();
        $totalClients   = Client::count();
        $totalEstimates = $estimateQuery->count();
        $totalRevenue   = $estimateQuery->sum('total');

        // ===== Monthly Revenue =====
        $monthlyRaw = Estimate::selectRaw('MONTH(issue_date) as month, SUM(total) as revenue')
            ->whereYear('issue_date', $year)
            ->groupByRaw('MONTH(issue_date)')
            ->pluck('revenue', 'month')
            ->toArray();

        $monthlyRevenue = [];
        for ($m = 1; $m <= 12; $m++) {
            $monthlyRevenue[] = $monthlyRaw[$m] ?? 0;
        }

        // ===== Status Analytics =====
        $statusRaw = Estimate::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        $statusCounts = [
            'draft'    => $statusRaw['draft'] ?? 0,
            'sent'     => $statusRaw['sent'] ?? 0,
            'approved' => $statusRaw['approved'] ?? 0,
            'rejected' => $statusRaw['rejected'] ?? 0,
        ];

        $recentEstimates = Estimate::with('client')
            ->latest()
            ->take(5)
            ->get();

        return view('home', compact(
            'totalUsers',
            'totalClients',
            'totalEstimates',
            'totalRevenue',
            'monthlyRevenue',
            'statusCounts',
            'recentEstimates'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | 👤 USER DASHBOARD (Multi-Tenant Safe)
    |--------------------------------------------------------------------------
    */
    private function userDashboard($user)
    {
        $year = date('Y');

        $estimateQuery = Estimate::where('created_by', $user->id);

        $totalClients   = Client::where('created_by', $user->id)->count();
        $totalEstimates = $estimateQuery->count();
        $totalRevenue   = $estimateQuery->sum('total');

        // ===== Monthly Revenue =====
        $monthlyRaw = Estimate::selectRaw('MONTH(issue_date) as month, SUM(total) as revenue')
            ->where('created_by', $user->id)
            ->whereYear('issue_date', $year)
            ->groupByRaw('MONTH(issue_date)')
            ->pluck('revenue', 'month')
            ->toArray();

        $monthlyRevenue = [];
        for ($m = 1; $m <= 12; $m++) {
            $monthlyRevenue[] = $monthlyRaw[$m] ?? 0;
        }

        // ===== Status Analytics =====
        $statusRaw = Estimate::select('status', DB::raw('count(*) as total'))
            ->where('created_by', $user->id)
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        $statusCounts = [
            'draft'    => $statusRaw['draft'] ?? 0,
            'sent'     => $statusRaw['sent'] ?? 0,
            'approved' => $statusRaw['approved'] ?? 0,
            'rejected' => $statusRaw['rejected'] ?? 0,
        ];

        $recentEstimates = Estimate::with('client')
            ->where('created_by', $user->id)
            ->latest()
            ->take(5)
            ->get();

        return view('home', compact(
            'totalClients',
            'totalEstimates',
            'totalRevenue',
            'monthlyRevenue',
            'statusCounts',
            'recentEstimates'
        ));
    }
}
