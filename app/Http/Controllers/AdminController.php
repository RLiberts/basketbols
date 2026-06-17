<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Nav piekļuves.');
        }

        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function updateRole(Request $request, User $user)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Nav piekļuves.');
        }
        $request->validate([
            'role' => 'required|in:user,manager,secretary,admin',
        ]);
        $user->update(['role' => $request->role]);
        return redirect()->route('admin.users.index')->with('success', 'Loma veiksmīgi mainīta!');
    }

    public function toggleBlock(User $user)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Nav piekļuves.');
        }
        $user->update(['blocked' => !$user->blocked]);
        $status = $user->blocked ? 'bloķēts' : 'atbloķēts';
        return redirect()->route('admin.users.index')->with('success', "Lietotājs veiksmīgi {$status}!");
    }
}