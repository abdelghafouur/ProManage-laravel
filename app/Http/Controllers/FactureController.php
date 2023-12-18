<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facture;
use App\Models\Client;
use App\Models\DetailFacture;
use App\Models\Entreprise;
use App\Models\Devis;
use App\Models\Paiment;

class FactureController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Display a listing of the factures.
    public function index()
    {
        $factures = Facture::paginate(10);
        return view('factures.index', compact('factures'));
    }

    // Show the form for creating a new facture.
    public function create(Request $request)
    {

        $selectedDevisId = $request->input('devis_id');
        $clients = Client::all();
        $entreprises = Entreprise::all();
        $devisList = Devis::all();
        $selectedDevisId = $selectedDevisId ?? null;
        if($selectedDevisId !== null)
            {
                $DevisByID = Devis::findOrFail($selectedDevisId);
                $detaildevis = $DevisByID->detailDevis;
                $ClientDevis = $DevisByID->client->id;
                $EntrepriseDevis = $DevisByID->entreprise->id;
            }
        else
            {
                $detaildevis = [];
                $DevisByID = [];
                $ClientDevis = [];
                $EntrepriseDevis = [];
            }

        return view('factures.create', compact('clients', 'entreprises', 'devisList','selectedDevisId','detaildevis','DevisByID','ClientDevis','EntrepriseDevis'));
    }

    // Store a newly created facture in the database.
    public function store(Request $request)
    {

        $request->validate([
            'client_id' => 'required',
            'entreprise_id' => 'required',
            'date' => 'required|date',
        ]);

        // Create a new Facture
        $facture = Facture::create([
            'client_id' => $request->input('client_id'),
            'entreprise_id' => $request->input('entreprise_id'),
            'devis_id' => $request->input('devis_id'),
            'date' => $request->input('date'),
            'devis' => $request->input('devis'),
            // Add other facture fields as needed
        ]);
        // Set the codeFacture using your desired logic
            $newId = $facture->id;
            $facture->update([
                'codeFacture' => 'FAC' . str_pad(date('m'), 2, '0', STR_PAD_LEFT) . str_pad(date('y') % 100, 2, '0', STR_PAD_LEFT) . '-' . str_pad($newId, 3, '0', STR_PAD_LEFT),
            ]);

        // Parse the JSON string to get an array of detail factures
        $detailFactures = json_decode($request->input('detail_factures')[0], true);

        // Loop through detail factures and associate them with the created Facture
        foreach ($detailFactures as $detail) {
            DetailFacture::create([
                'facture_id' => $facture->id,
                'designation' => $detail['designation'],
                'puht' => $detail['puht'],
                'qte' => $detail['qte'],
                'tva' => $detail['tva'],
                // Add other detail facture fields as needed
            ]);
        }

        return redirect()->route('factures.index')->with('success', 'Facture created successfully');
    }

    public function show($id)
{
    // Find the facture by ID with the associated client, entreprise, and detailFactures
    $facture = Facture::with(['client', 'entreprise', 'detailFacture','paiments'])->findOrFail($id);
    $totalMontant = 0;

    // Check if the facture has associated payments
    if ($facture->paiments) {
        // Iterate over the payments and accumulate the montant values
        foreach ($facture->paiments as $paiment) {
            $totalMontant += $paiment->montant;
        }
    }

    $codeDevisFC = null;
    if($facture->devis_id != null)
        {
            $Devis = Devis::findOrFail($facture->devis_id);
            $codeDevisFC = $Devis->codeDevis;
        }
    // Return the view with the facture data
    return view('factures.show', compact('facture','codeDevisFC','totalMontant'));
    
}

    // Show the form for editing the specified facture.
    public function edit($id)
    {
        $facture = Facture::findOrFail($id);
        $detailFacture = $facture->detailFacture;
        $clients = Client::all();
        $entreprises = Entreprise::all();
        $devisList = Devis::all();

        return view('factures.edit', compact('facture', 'clients', 'entreprises', 'devisList','detailFacture'));
    }

    // Update the specified facture in the database.
    public function update(Request $request, $id)
    {
    
        $validatedData = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'entreprise_id' => 'required|exists:entreprises,id',
            'devis_id' => 'nullable|exists:devis,id',
            'date' => 'nullable|date',
            'devis' => 'nullable',
            // Add validation for other fields as needed
            'designation.*' => 'nullable|string',
            'puht.*' => 'nullable',
            'qte.*' => 'nullable',
            'tva.*' => 'nullable',
        ]);

        $facture = Facture::findOrFail($id);
        // Update the existing fields
        $facture->client_id = $validatedData['client_id'];
        $facture->entreprise_id = $validatedData['entreprise_id'];
        $facture->devis_id = $validatedData['devis_id'];
        $facture->date = $validatedData['date'];
        $facture->devis = $validatedData['devis'];

        // Save the updated Devis model
        $facture->save();

                // Update existing details if the required fields are present
        if (
            isset($validatedData['designation']) &&
            isset($validatedData['puht']) &&
            isset($validatedData['qte']) &&
            isset($validatedData['tva'])
        ) {
            // Loop through and update existing details
            for ($i = 0; $i < count($validatedData['designation']); $i++) {
                // Check if the detail with the same index exists in both the model and the request
                if (
                    isset($facture->detailFacture[$i]) &&
                    isset($validatedData['designation'][$i]) &&
                    isset($validatedData['puht'][$i]) &&
                    isset($validatedData['qte'][$i]) &&
                    isset($validatedData['tva'][$i])
                ) {
                    // Update the existing detail
                    $facture->detailFacture[$i]->update([
                        'designation' => $validatedData['designation'][$i],
                        'puht' => $validatedData['puht'][$i],
                        'qte' => $validatedData['qte'][$i],
                        'tva' => $validatedData['tva'][$i],
                    ]);
                }
            }
        }

        return redirect()->route('factures.index')->with('success', 'Facture updated successfully.');
    }

    // Remove the specified facture from the database.
    public function destroy($id)
    {
        if (auth()->user()->hasRole('superadmin')) {
            $facture = Facture::findOrFail($id);
            $facture->delete();
            return redirect()->route('factures.index')->with('success', 'Facture deleted successfully.');
        } else {
            return response()->json(['error' => 'You are not allowed to delete this facture.'], 403);
        }
    }
}
