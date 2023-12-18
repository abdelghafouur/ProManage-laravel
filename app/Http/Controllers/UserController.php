<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'roles' => 'required',
        ]);
        // Hash the password
        $hashedPassword = Hash::make($request->input('password'));
        // Handle file upload
        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('profile_photos', $fileName, 'public'); // Store in the 'public' disk under 'profile_photos' folder
        }

        // Create the user with the hashed password
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $hashedPassword,
        ]);

        // Assign the role to the user
        $role = Role::where('name', $request->input('roles'))->first();
        $user->assignRole($role);

        // Attach the profile photo path to the user
        if (isset($filePath)) {
            $user->update(['profile_photo_path' => $filePath]);
        }
        else
            {
                $user->update(['profile_photo_path' => 'profile_photos/admin1.png']);
            }

        return redirect()->route('users.index')->with('success', 'User created successfully with the role ' . $request->input('role'));
    }
    

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        // Add this in your controller just before returning the view
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        // Find the user
        $user = User::findOrFail($id);

        // Update other user details
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);

        // Update password if a new one is provided
        if ($request->filled('password')) {
            $user->update([
                'password' => Hash::make($request->input('password')),
            ]);
        }

        // Handle profile photo update
        if ($request->hasFile('profile_photo')) {
            // Store the new profile photo
            $file = $request->file('profile_photo');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('profile_photos', $fileName, 'public');
            $user->update(['profile_photo_path' => $filePath]);
        }

        // Assign the new role to the user if it has changed
        $newRole = Role::where('name', $request->input('roles'))->first();

        if ($newRole && !$user->hasRole($newRole)) {
            // Remove old roles
            $user->roles()->detach();

            // Assign the new role
            $user->assignRole($newRole);
        }

        if (auth()->user()->hasRole('comptable')) 
            {
                return redirect()->route('factures.index')->with('success', 'User updated successfully.');
            }
        else
            {
                return redirect()->route('users.index')->with('success', 'User updated successfully.');
            }
    }

    public function destroy($id)
    {
        if (auth()->user()->hasRole('superadmin')) 
            {
                $user = user::findOrFail($id);
                $user->delete();
                return redirect()->route('users.index')->with('success', 'user deleted successfully.'); 
            }
        else
            {
                return response()->json(['error' => 'You are not allowed to delete this user.'], 403);
            }

    }
}
