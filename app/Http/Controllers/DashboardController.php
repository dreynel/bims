<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resident;
use App\Models\Certificate;
use App\Models\BlotterRecord;
use App\Models\AidDistribution;

class DashboardController extends Controller
{
    public function index()
    {
        $totalResidents = Resident::count();
        $registeredVoters = Resident::where('voter_status', 'Registered')->count();
        $seniorCitizens = Resident::where('is_senior', 1)->count();
        $pwdCount = Resident::where('is_pwd', 1)->count();
        $indigentCount = Resident::where('is_indigent', 1)->count();
        $fourPsCount = Resident::where('is_4ps', 1)->count();
        $soloParents = Resident::where('is_solo_parent', 1)->count();

        // Financial Collections
        $collectionsThisMonth = Certificate::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('amount_paid');
        $clearanceCount = Certificate::whereMonth('created_at', now()->month)->count();

        // Blotter & KP statistics
        $activeBlotters = BlotterRecord::where('status', 'In Mediation')->count();
        $settledBlotters = BlotterRecord::where('status', 'Settled')->count();
        $totalBlotters = BlotterRecord::count();
        $resolutionRate = $totalBlotters > 0 ? round(($settledBlotters / $totalBlotters) * 100, 1) : 100;

        // Pending citizen requests (queued from public portal)
        $pendingRequests = Certificate::whereIn('status', ['Pending', 'Evaluated', 'Approved', 'Ready for Release'])
            ->latest()
            ->take(6)
            ->get();

        // Purok demographics distribution
        $purokData = Resident::selectRaw('purok, count(*) as count')
            ->groupBy('purok')
            ->orderBy('purok')
            ->pluck('count', 'purok')
            ->toArray();

        // Recent blotter for preview
        $activeBlotterItem = BlotterRecord::where('status', 'In Mediation')->latest()->first()
            ?? BlotterRecord::latest()->first();

        return view('admin.dashboard', compact(
            'totalResidents',
            'registeredVoters',
            'seniorCitizens',
            'pwdCount',
            'indigentCount',
            'fourPsCount',
            'soloParents',
            'collectionsThisMonth',
            'clearanceCount',
            'activeBlotters',
            'settledBlotters',
            'resolutionRate',
            'pendingRequests',
            'purokData',
            'activeBlotterItem'
        ));
    }
}
