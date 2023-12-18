<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entreprise;
use App\Models\Client;

class EntrepriseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $entreprises = Entreprise::paginate(10);
        return view('entreprises.index', compact('entreprises'));
    }

    public function create()
    {
        return view('entreprises.create');
    }
    public function updateEntrepriseDefault(Request $request)
    {
        $entrepriseId = $request->input('entreprise_id');
        $entreprise = Entreprise::find($entrepriseId);
        if (!$entreprise) {
            return response()->json(['error' => 'Entreprise not found'], 404);
        }

        // Update the default column in the database
        Entreprise::where('default', '=', 1)->update(['default' => 0]);
        $entreprise->update(['default' => 1]);

        return redirect()->route('entreprises.index')->with('success', 'default entreprise update successfully.');
    }

    public function store(Request $request)
{
    $request->validate([
        'nom' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'adresse' => 'required|string|max:255',
        'telephone' => 'required|string|max:30',
        'site' => 'required|string|max:255',
        'patente' => 'required|string|max:255',
        'ice' => 'required|string|max:255',
        'if' => 'required|string|max:255',
        'cnss' => 'required|string|max:255',
        'banque' => 'required|string|max:255',
        'rib' => 'required|string|max:255',
        'swift' => 'required|string|max:255',
        'iban' => 'required|string|max:255',
        'validite' => 'required|string|max:255',
    ]);

    $entreprise = Entreprise::create($request->all());
    // Handle file upload
    if ($request->hasFile('profile_photo')) {
        $file = $request->file('profile_photo');
        
        $fileName = time() . '_' . $file->getClientOriginalName();
        $fileExtension = $file->getClientOriginalExtension();
        $filePath = $file->storeAs('profile_photos', $fileName, 'public');
        $entreprise->update(['logo' => $filePath]);
        $entreprise->update(['typelogo' => $fileExtension]);
    }

    // Attach the profile photo path to the user
    if (isset($filePath)) {
        $entreprise->update(['logo' => $filePath]);
    }

    return redirect()->route('entreprises.index')->with('success', 'entreprise created successfully.');
}

    public function show($id)
    {
        $entreprise = Entreprise::findOrFail($id);
        return view('entreprises.show', compact('entreprise'));
    }

    public function edit($id)
    {
        $entreprise = Entreprise::findOrFail($id);
        return view('entreprises.edit', compact('entreprise'));
    }

    public function update(Request $request, $id)
    {
        $entreprise = Entreprise::findOrFail($id);
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'adresse' => 'required|string|max:255',
            'telephone' => 'required|string|max:30',
            'site' => 'required|string|max:255',
            'patente' => 'required|string|max:255',
            'ice' => 'required|string|max:255',
            'if' => 'required|string|max:255',
            'cnss' => 'required|string|max:255',
            'banque' => 'required|string|max:255',
            'rib' => 'required|string|max:255',
            'swift' => 'required|string|max:255',
            'iban' => 'required|string|max:255',
            'validite' => 'required|string|max:255',
        ]);

        $entreprise->update($request->all());
        // Handle profile photo update
        if ($request->hasFile('profile_photo')) {
            // Store the new profile photo
            $file = $request->file('profile_photo');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $fileExtension = $file->getClientOriginalExtension();
            $filePath = $file->storeAs('profile_photos', $fileName, 'public');
            $entreprise->update(['logo' => $filePath]);
            $entreprise->update(['typelogo' => $fileExtension]);
        }

        return redirect()->route('entreprises.index')->with('success', 'entreprise updated successfully.');
    }

    public function destroy($id)
    {
        if (auth()->user()->hasRole('superadmin')) 
            {
                $entreprise = Entreprise::findOrFail($id);
                $entreprise->delete();
                return redirect()->route('entreprises.index')->with('success', 'entreprise deleted successfully.'); 
            }
        else
            {
                return response()->json(['error' => 'You are not allowed to delete this entreprise.'], 403);
            }

    }
}
