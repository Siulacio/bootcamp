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
        return view('chirps.index');
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

    public function edit(Chirp $chirp)
    {
        // TODO
    }

    public function update(Request $request, Chirp $chirp)
    {
        // TODO
    }

    public function destroy(Chirp $chirp)
    {
        // TODO
    }
}
