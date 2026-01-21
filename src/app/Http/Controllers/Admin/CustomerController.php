<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerController extends Controller
{
    /**
     * Display a listing of customers.
     */
    public function index(Request $request): View
    {
        $query = User::withCount(['orders as total_orders' => function ($q) {
            $q->where('status', 'completed');
        }])
            ->withSum(['orders as total_spent' => function ($q) {
                $q->where('status', 'completed');
            }], 'total');

        // Search by name or email
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('company', 'like', "%{$search}%");
            });
        }

        // Filter by has orders
        if ($request->boolean('with_orders')) {
            $query->has('orders');
        }

        $customers = $query->latest()->paginate(20);

        // Stats
        $stats = [
            'total' => User::count(),
            'with_orders' => User::has('orders')->count(),
            'total_revenue' => User::withSum(['orders as total' => function ($q) {
                $q->where('status', 'completed');
            }], 'total')->get()->sum('total'),
        ];

        return view('admin.customers.index', compact('customers', 'stats'));
    }

    /**
     * Display the specified customer.
     */
    public function show(User $customer): View
    {
        $customer->loadCount(['orders as total_orders' => function ($q) {
            $q->where('status', 'completed');
        }]);

        $orders = $customer->orders()
            ->with(['items.formation'])
            ->latest()
            ->get();

        $downloads = $customer->downloads()
            ->with(['formation', 'order'])
            ->latest()
            ->get();

        $ownedFormations = $customer->ownedFormations();

        return view('admin.customers.show', compact(
            'customer',
            'orders',
            'downloads',
            'ownedFormations'
        ));
    }

    /**
     * Export customers to CSV.
     */
    public function export(Request $request)
    {
        $customers = User::withCount(['orders as total_orders' => function ($q) {
            $q->where('status', 'completed');
        }])
            ->withSum(['orders as total_spent' => function ($q) {
                $q->where('status', 'completed');
            }], 'total')
            ->get();

        $filename = 'clients-' . now()->format('Y-m-d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($customers) {
            $file = fopen('php://output', 'w');

            // UTF-8 BOM for Excel
            fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));

            // Header row
            fputcsv($file, [
                'ID',
                'Nom',
                'Email',
                'Entreprise',
                'Téléphone',
                'Ville',
                'Pays',
                'Commandes',
                'Total dépensé',
                'Inscrit le',
            ], ';');

            foreach ($customers as $customer) {
                fputcsv($file, [
                    $customer->id,
                    $customer->name,
                    $customer->email,
                    $customer->company ?? '-',
                    $customer->phone ?? '-',
                    $customer->city ?? '-',
                    $customer->country ?? '-',
                    $customer->total_orders ?? 0,
                    number_format($customer->total_spent ?? 0, 2, ',', ' ') . ' €',
                    $customer->created_at->format('d/m/Y'),
                ], ';');
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
