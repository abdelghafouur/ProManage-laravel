<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailFacture; 

class DetailFactureController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {

        $factureId = $request->input('facture_id');
        // Create a new detail with the specified facture_id
        $detail = DetailFacture::create([
            'facture_id' => $request->input('facture_id'),
            'designation' => $request->input('designation'),
            'puht' => $request->input('puht'),
            'qte' => $request->input('qte'),
            'tva' => $request->input('tva'),
        ]);
    
        return redirect()->route('factures.edit', ['facture' => $factureId])
    ->with('success', 'facture edited successfully');
    }
    
    public function show($id)
    {
        $detail = DetailFacture::findOrFail($id);

        return view('factures.edit', compact('detail'));
    }


    public function update(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'designation' => 'required|string|max:255',
            'puht' => 'required',
            'qte' => 'required',
            'tva' => 'required',
            // Add other validation rules as needed
        ]);

        $id_detail =  $request->input('detailfacture_id');

        // Find the detail by ID
        $detail = DetailFacture::findOrFail($id_detail);

        // Update the detail with the validated data
        $detail->update($validatedData);

        return redirect()->route('factures.edit', ['facture' => $id])
    ->with('success', 'facture edited successfully');
    }

    public function destroy($id)
    {
        $detail = DetailFacture::findOrFail($id);

        // Delete the detail
        DetailFacture::findOrFail($id)->delete();

        return redirect()->route('factures.edit', ['facture' => $detail->facture_id])
        ->with('success', 'facture edited successfully');
    }
}
