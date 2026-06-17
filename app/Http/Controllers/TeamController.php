<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::with('manager')->get();
        return view('teams.index', compact('teams'));
    }

    public function show(Team $team)
    {
        return view('teams.show', compact('team'));
    }

    public function create(Request $request)
    {
        if ($request->user()->cannot('create', Team::class)) {
            abort(403);
        }
        $managers = User::where('role', 'manager')->get();
        return view('teams.create', compact('managers'));
    }

    public function store(Request $request)
    {
        if ($request->user()->cannot('create', Team::class)) {
            abort(403);
        }
        $request->validate([
            'name' => 'required|string|max:255',
            'manager_id' => 'nullable|exists:users,id',
            'city' => 'nullable|string|max:255',
            'logo' => 'nullable|image|max:2048',
        ]);
        $data = $request->except('logo');

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        Team::create($data);
        return redirect()->route('teams.index')->with('success',  __('messages.team_added'));
    }

    public function edit(Request $request,Team $team)
    {
        if ($request->user()->cannot('update', $team)) {
            abort(403);
        }
        $managers = User::where('role', 'manager')->get();
        return view('teams.edit', compact('team', 'managers'));
    }

    public function update(Request $request, Team $team)
    {
        if ($request->user()->cannot('update', $team)) {
            abort(403);
        }
        $request->validate([
            'name' => 'required|string|max:255',
            'manager_id' => 'nullable|exists:users,id',
            'city' => 'nullable|string|max:255',
            'logo' => 'nullable|image|max:2048',
        ]);

        $data = $request->except(['logo', 'remove_logo']);
        if ($request->hasFile('logo')) {
            if ($team->logo) {
                Storage::disk('public')->delete($team->logo);
            }
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }elseif ($request->has('remove_logo')) {
            if ($team->logo) {
                Storage::disk('public')->delete($team->logo);
            }
            $data['logo'] = null;
        }

        $team->update($data);
        return redirect()->route('teams.show', $team)->with('success', __('messages.team_updated'));


    }

    public function destroy(Request $request, Team $team)
    {
        if ($request->user()->cannot('delete', $team)) {
            abort(403);
        }
        if ($team->logo) {
            Storage::disk('public')->delete($team->logo);
        }
        $team->delete();
        return redirect()->route('teams.index')->with('success', __('messages.team_deleted'));
    }
}