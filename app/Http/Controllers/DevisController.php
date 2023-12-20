<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Devis;
use App\Models\Client;
use App\Models\Entreprise;
use App\Models\DetailDevis;
class DevisController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Display a listing of the devis.
    public function index()
    {
        $devisList = Devis::paginate(10);
        return view('devis.index', compact('devisList'));
    }

    
    // Show the form for creating a new devis.
    public function create()
    {
        $clients = Client::all();
        $entreprises = Entreprise::all();
        return view('devis.create', compact('clients', 'entreprises'));
    }

    // Store a newly created devis in the database.
    public function store(Request $request)
    {
        $request->validate([
            'conditionsDeReglement' => 'required',
            'date' => 'nullable|date',
            'devis' => 'required',
            'client_id' => 'required|exists:clients,id',
        ]);

        $entrepriseDefault = Entreprise::where('default', 1)->value('id');
        // Create a new devis
        $devis = Devis::create([
            'client_id' => $request->input('client_id'),
            'entreprise_id' => $entrepriseDefault,
            'designationDev' => $request->input('designationDev'),
            'conditionsDeReglement' => $request->input('conditionsDeReglement'),
            'date' => $request->input('date'),
            'devis' => $request->input('devis'),
            // Add other devis fields as needed
        ]);

        // Set the codeFacture using your desired logic
        $newId = $devis->id;
        $devis->update([
            'codeDevis' => 'DV' . str_pad(date('m'), 2, '0', STR_PAD_LEFT) . str_pad(date('y') % 100, 2, '0', STR_PAD_LEFT) . '-' . str_pad($newId, 3, '0', STR_PAD_LEFT),
        ]);

        // Parse the JSON string to get an array of detail deviss
        $detailDeviss = json_decode($request->input('detail_deviss')[0], true);

        // Loop through detail deviss and associate them with the created devis
        foreach ($detailDeviss as $detail) {
            DetailDevis::create([
                'devis_id' => $devis->id,
                'designation' => $detail['designation'],
                'puht' => $detail['puht'],
                'qte' => $detail['qte'],
                'tva' => $detail['tva'],
                // Add other detail devis fields as needed
            ]);
        }


        return redirect()->route('devis.index')->with('success', 'Devis created successfully.');
    }

    public function show($id)
    {
        // Find the facture by ID with the associated client, entreprise, and detailFactures
        $devis = Devis::with(['client', 'entreprise', 'detailDevis'])->findOrFail($id);
    
        // Return the view with the facture data
        return view('devis.show', compact('devis'));
    }
    
    // Show the form for editing the specified devis.
    public function edit($id)
    {
        $devis = Devis::findOrFail($id);
        $detailDevis = $devis->detailDevis; 
        $clients = Client::all();
        $entreprises = Entreprise::all();
        return view('devis.edit', compact('devis', 'clients', 'entreprises', 'detailDevis'));
    }

    // Update the specified devis in the database.

    public function update(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'conditionsDeReglement' => 'required|string',
            'date' => 'date',
            'devis' => 'required|string',
            'designationDev' => 'nullable|string',
            'client_id' => 'required|exists:clients,id',
        ]);
        $entrepriseDefault = Entreprise::where('default', 1)->value('id');
    
        // Find the Devis model by ID
        $devis = Devis::findOrFail($id);

        // Update the existing fields
        $devis->designationDev = $validatedData['designationDev'];
        $devis->conditionsDeReglement = $validatedData['conditionsDeReglement'];
        $devis->date = $validatedData['date'];
        $devis->devis = $validatedData['devis'];
        $devis->client_id = $validatedData['client_id'];
        $devis->entreprise_id = $entrepriseDefault;

        // Save the updated Devis model
        $devis->save();
    
        // Redirect to the index page or show success message
        return redirect()->route('devis.index')->with('success', 'Devis updated successfully');
    }
    

    // Remove the specified devis from the database.
    public function destroy($id)
    {
        if (auth()->user()->hasRole('superadmin')) 
            {
                $devis = Devis::findOrFail($id);
                $devis->delete();
                return redirect()->route('devis.index')->with('success', 'Devis deleted successfully.'); 
            }
        else
            {
                return response()->json(['error' => 'You are not allowed to delete this devis.'], 403);
            }
    }
}
