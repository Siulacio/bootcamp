<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ChirpController extends Controller
{
    public function index(): View
    {
        return view('chirps.index', [
            'chirps' => Chirp::with('user')->latest()->get(),
        ]);
    }

    public function create()
    {
        // TODO
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'message' => ['required', 'min:3', 'max:255'],
        ]);

        $request->user()->chirps()->create($validated);

        return to_route('chirps.index')
            ->with('status', __('Chirp created successfully!'));
    }

    public function show(Chirp $chirp)
    {
        // TODO
    }

    public function edit(Chirp $chirp): View
    {
        return view('chirps.edit', [
            'chirp' => $chirp,
        ]);
    }

    public function update(Request $request, Chirp $chirp)
    {
        $validated = $request->validate([
            'message' => ['required', 'min:3', 'max:255'],
        ]);

        $chirp->update($validated);

        return to_route('chirps.index')
            ->with('status', __('Chirp updated successfully!'));
    }

    public function destroy(Chirp $chirp)
    {
        // TODO
    }
}
