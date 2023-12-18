<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailDevis;

class DetailDevisController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {

        $devisId = $request->input('devis_id');
        // Create a new detail with the specified devis_id
        $detail = DetailDevis::create([
            'devis_id' => $request->input('devis_id'),
            'designation' => $request->input('designation'),
            'puht' => $request->input('puht'),
            'qte' => $request->input('qte'),
            'tva' => $request->input('tva'),
        ]);
    
        return redirect()->route('devis.edit', ['devi' => $devisId])
    ->with('success', 'Devis edited successfully');
    }
    
    

    public function show($id)
    {
        $detail = DetailDevis::findOrFail($id);

        return view('devis.edit', compact('detail'));
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
        $id_detail =  $request->input('detaildevis_id');

        // Find the detail by ID
        $detail = DetailDevis::findOrFail($id_detail);

        // Update the detail with the validated data
        $detail->update($validatedData);

        return redirect()->route('devis.edit', ['devi' => $id])
    ->with('success', 'Devis edited successfully');
    }

    public function destroy($id)
    {
        $detail = DetailDevis::findOrFail($id);

        // Delete the detail
        DetailDevis::findOrFail($id)->delete();

        return redirect()->route('devis.edit', ['devi' => $detail->devis_id])
        ->with('success', 'Devis edited successfully');
    }
}
