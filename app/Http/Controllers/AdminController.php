<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        if (!auth()->user()->isAdmin()) {
            abort(403,  __('messages.no_access'));
        }

        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function updateRole(Request $request, User $user)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403,  __('messages.no_access'));
        }
        $request->validate([
            'role' => 'required|in:user,manager,secretary,admin',
        ]);
        $user->update(['role' => $request->role]);
        return redirect()->route('admin.users.index')->with('success',  __('messages.role_updated'));
    }

    public function toggleBlock(User $user)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403,  __('messages.no_access'));
        }
        $user->update(['blocked' => !$user->blocked]);
        $status = $user->blocked ? __('messages.user_blocked_success') : __('messages.user_unblocked_success');
        return redirect()->route('admin.users.index')->with('success', $status);
    }
}