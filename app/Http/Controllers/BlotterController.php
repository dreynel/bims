<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlotterRecord;

class BlotterController extends Controller
{
    public function index(Request $request)
    {
        $query = BlotterRecord::query();

        if ($request->filled('status') && $request->status !== 'All') {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('case_no', 'LIKE', "%{$search}%")
                  ->orWhere('complainant_name', 'LIKE', "%{$search}%")
                  ->orWhere('respondent_name', 'LIKE', "%{$search}%")
                  ->orWhere('incident_type', 'LIKE', "%{$search}%");
            });
        }

        $records = $query->latest('incident_date')->paginate(12)->withQueryString();
        $activeCount = BlotterRecord::where('status', 'In Mediation')->count();
        $settledCount = BlotterRecord::where('status', 'Settled')->count();

        return view('admin.blotter.index', compact('records', 'activeCount', 'settledCount'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'complainant_name' => 'required|string|max:150',
            'complainant_address' => 'nullable|string|max:255',
            'complainant_contact' => 'nullable|string|max:20',
            'respondent_name' => 'required|string|max:150',
            'respondent_address' => 'nullable|string|max:255',
            'incident_type' => 'required|string|max:100',
            'incident_location' => 'required|string|max:255',
            'incident_date' => 'required|date',
            'narrative' => 'required|string',
            'presiding_officer' => 'nullable|string|max:100',
            'hearing_date' => 'nullable|date',
        ]);

        do {
            $randNum = mt_rand(100, 999);
            $caseNo = 'BLT-' . date('Y') . '-' . $randNum;
        } while (BlotterRecord::where('case_no', $caseNo)->exists());

        $record = BlotterRecord::create(array_merge($validated, [
            'case_no' => $caseNo,
            'status' => 'In Mediation',
        ]));

        return redirect()->route('admin.blotter.index')
            ->with('success', "Blotter Case #{$caseNo} registered under Katarungang Pambarangay.");
    }

    public function update(Request $request, $id)
    {
        $record = BlotterRecord::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:Pending,In Mediation,Settled,Referred to PNP,Dismissed',
            'hearing_date' => 'nullable|date',
            'presiding_officer' => 'nullable|string|max:100',
            'resolution_details' => 'nullable|string',
        ]);

        $record->update($validated);

        return redirect()->route('admin.blotter.index')
            ->with('success', "Case #{$record->case_no} status updated to {$record->status}.");
    }
}
