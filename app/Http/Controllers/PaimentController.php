<?php

namespace App\Http\Controllers;

use App\Models\Paiment;
use App\Models\Facture;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PaimentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $paiments = Paiment::paginate(10);
        return view('paiments.index', compact('paiments'));
    }
    public function create()
    {
        
        $facture_id = request('facture_id');

        return view('paiments.create', compact('facture_id'));
    }
    // Store a newly created payment in the database.
    public function store(Request $request)
    {
        // Validation logic
        $validatedData = $request->validate([
            'facture_id' => 'required|exists:factures,id',
            'date' => 'required|date',
            'montant' => 'required|numeric',
            'note' => 'nullable|string',
            'method' => 'nullable|string',
            'numero' => 'nullable',
        ]);

        Paiment::create($validatedData);

        return redirect()->route('factures.show', $request->facture_id)->with('success', 'Payment added successfully');
    }
    // Show the form for editing the specified payment.
    public function edit($id)
    {
        $paiment = Paiment::findOrFail($id);

        return view('paiments.edit', compact('paiment'));
    }

    // Update the specified payment in the database.
    public function update(Request $request, $id)
    {
        // Validation logic
        $validatedData = $request->validate([
            'date' => 'required|date',
            'montant' => 'required|numeric',
            'note' => 'nullable|string',
            'method' => 'nullable|string',
            'numero' => 'nullable',
        ]);
        $paiment = Paiment::findOrFail($request->input('detailpaiment_id'));
        $paiment->update($validatedData);

        return redirect()->route('factures.show', $paiment->facture_id)->with('success', 'Payment updated successfully');
    }
    public function destroy($id)
    {
        if (auth()->user()->hasRole('superadmin')) {
            
            $paiment = Paiment::findOrFail($id);
            $facture_id = $paiment->facture_id;
    
            $paiment->delete();
    
            return redirect()->route('factures.show', $facture_id)->with('success', 'Payment deleted successfully');
        } else {
            return response()->json(['error' => 'You are not allowed to delete this paiment.'], 403);
        }
    }
}
