<?php

// app/Http/Controllers/UserController.php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $companyId = 1; // <- replace with real company ID during dev
        $users = User::where('company_id', $companyId)->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->merge([
            'name' => trim($request->first_name . ' ' . $request->last_name),
        ]);
    
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'name' => 'required|string|max:255', // concatenated
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'required|string',
        ]);
    
        User::create([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'name'       => $request->name,
            'email'      => $request->email,
            'password'   => bcrypt($request->password),
            'role'       => $request->role,
            'company_id' => auth()->user()->company_id ?? 1, // fallback for now
            'is_active'  => $request->has('is_active'),
        ]);
    
        return redirect()->route('users.index')->with('success', 'Utilisateur ajouté avec succès.');
    }

    public function edit(User $user)
    {
        // Optional: authorize the user belongs to the same company
        abort_if($user->company_id !== auth()->user()->company_id, 403);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        abort_if($user->company_id !== auth()->user()->company_id, 403);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role ?? $user->role,
        ]);

        return redirect()->route('users.index')->with('success', 'Utilisateur mis à jour.');
    }

    public function destroy(User $user)
    {
        abort_if($user->company_id !== auth()->user()->company_id, 403);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé.');
    }
}