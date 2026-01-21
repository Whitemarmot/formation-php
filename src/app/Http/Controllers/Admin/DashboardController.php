<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Download;
use App\Models\Formation;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index(): View
    {
        // Key metrics
        $totalRevenue = Order::completed()->sum('total');
        $totalOrders = Order::completed()->count();
        $totalCustomers = User::whereHas('orders', function ($q) {
            $q->where('status', 'completed');
        })->count();
        $totalDownloads = Download::sum('download_count');

        // Revenue this month
        $monthlyRevenue = Order::completed()
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('total');

        // Orders this month
        $monthlyOrders = Order::completed()
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        // Revenue chart data (last 12 months)
        $revenueChart = $this->getRevenueChartData();

        // Recent orders
        $recentOrders = Order::with(['user', 'items.formation'])
            ->latest()
            ->limit(10)
            ->get();

        // Top selling formations
        $topFormations = Formation::withCount(['orderItems as sales_count' => function ($query) {
            $query->whereHas('order', function ($q) {
                $q->where('status', 'completed');
            });
        }])
            ->orderByDesc('sales_count')
            ->limit(5)
            ->get();

        // Pending orders
        $pendingOrders = Order::pending()->count();

        // Failed orders (last 24h)
        $failedOrders = Order::failed()
            ->where('created_at', '>=', now()->subDay())
            ->count();

        return view('admin.dashboard', compact(
            'totalRevenue',
            'totalOrders',
            'totalCustomers',
            'totalDownloads',
            'monthlyRevenue',
            'monthlyOrders',
            'revenueChart',
            'recentOrders',
            'topFormations',
            'pendingOrders',
            'failedOrders'
        ));
    }

    /**
     * Get revenue chart data for the last 12 months.
     */
    protected function getRevenueChartData(): array
    {
        $data = Order::completed()
            ->select(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(total) as revenue'),
                DB::raw('COUNT(*) as orders')
            )
            ->where('created_at', '>=', now()->subMonths(12))
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        $labels = [];
        $revenues = [];
        $orders = [];

        // Fill in missing months with zeros
        for ($i = 11; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $year = $date->year;
            $month = $date->month;
            $labels[] = $date->translatedFormat('M Y');

            $found = $data->first(function ($item) use ($year, $month) {
                return $item->year == $year && $item->month == $month;
            });

            $revenues[] = $found ? (float) $found->revenue : 0;
            $orders[] = $found ? (int) $found->orders : 0;
        }

        return [
            'labels' => $labels,
            'revenues' => $revenues,
            'orders' => $orders,
        ];
    }
}
