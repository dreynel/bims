<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AidDistribution;
use App\Models\Resident;

class AidDistributionController extends Controller
{
    public function index(Request $request)
    {
        $query = AidDistribution::query();

        if ($request->filled('program') && $request->program !== 'All') {
            $query->where('program_name', $request->program);
        }

        $distributions = $query->latest('distribution_date')->paginate(15)->withQueryString();
        $residents = Resident::where(function($q) {
            $q->where('is_indigent', 1)
              ->orWhere('is_4ps', 1)
              ->orWhere('is_senior', 1)
              ->orWhere('is_pwd', 1);
        })->orderBy('last_name')->get();

        $totalClaimed = AidDistribution::where('status', 'Claimed')->count();

        return view('admin.aid.index', compact('distributions', 'residents', 'totalClaimed'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'program_name' => 'required|string|max:150',
            'distribution_date' => 'required|date',
            'resident_id' => 'required|exists:residents,id',
            'assistance_type' => 'required|string',
            'amount_or_quantity' => 'required|string|max:100',
            'distributor_name' => 'nullable|string|max:100',
        ]);

        $resident = Resident::findOrFail($validated['resident_id']);

        AidDistribution::create([
            'program_name' => $validated['program_name'],
            'distribution_date' => $validated['distribution_date'],
            'resident_id' => $resident->id,
            'beneficiary_name' => $resident->full_name,
            'purok' => $resident->purok,
            'assistance_type' => $validated['assistance_type'],
            'amount_or_quantity' => $validated['amount_or_quantity'],
            'status' => 'Claimed',
            'distributor_name' => $validated['distributor_name'] ?? 'Barangay Dacutan Council',
        ]);

        return redirect()->route('admin.aid.index')
            ->with('success', "Assistance logged for {$resident->full_name} ({$validated['program_name']})!");
    }
}
