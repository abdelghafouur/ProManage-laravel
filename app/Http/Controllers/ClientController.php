<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Display a listing of the clients.
    public function index()
    {
        $clients = Client::paginate(10);
        return view('clients.index', compact('clients'));
    }

    // Show the form for creating a new client.
    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'email' => 'required|',
            'telephone' => 'required',
            'type' => 'required|in:Entreprise,Particulier,Autre',
            'adresse' => 'nullable',
            'ice' => 'nullable|integer',
        ]);
    
        $client = Client::create($request->all());
    
        // Set the codeFacture using your desired logic
        $newId = $client->id;
        $client->update([
            'codeClient' => 'CL' . str_pad(date('m'), 2, '0', STR_PAD_LEFT) . str_pad(date('y') % 100, 2, '0', STR_PAD_LEFT) . '-' . str_pad($newId, 3, '0', STR_PAD_LEFT),
        ]);
    
        return redirect()->route('clients.index')->with('success', 'Client created successfully.');
    }
    
    // Display the specified client by ID.
    public function show($id)
    {
        $client = Client::findOrFail($id);
        return view('clients.show', compact('client'));
    }

    // Show the form for editing the specified client by ID.
    public function edit($id)
    {
        $client = Client::findOrFail($id);
        return view('clients.edit', compact('client'));
    }

    // Update the specified client in the database by ID.
    public function update(Request $request, $id)
    {
        $client = Client::findOrFail($id);
        $request->validate([
            'nom' => 'required',
            'email' => 'required',
            'telephone' => 'required',
            'type' => 'required|in:Entreprise,Particulier,Autre',
            'adresse' => 'nullable',
            'ice' => 'nullable|integer',
        ]);

        $client->update($request->all());

        return redirect()->route('clients.index')->with('success', 'Client updated successfully.');
    }

    // Remove the specified client from the database by ID.
    public function destroy($id)
    {
        if (auth()->user()->hasRole('superadmin')) 
            {
                $client = Client::findOrFail($id);
                $client->delete();
                return redirect()->route('clients.index')->with('success', 'Client deleted successfully.'); 
            }
        else
            {
                return response()->json(['error' => 'You are not allowed to delete this client.'], 403);
            }

    }
}