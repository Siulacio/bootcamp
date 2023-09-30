<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Auth\Access\AuthorizationException;
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

    /**
     * @throws AuthorizationException
     */
    public function edit(Chirp $chirp): View
    {
        $this->authorize('update', $chirp);

        return view('chirps.edit', [
            'chirp' => $chirp,
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function update(Request $request, Chirp $chirp): RedirectResponse
    {
        $this->authorize('update', $chirp);

        $validated = $request->validate([
            'message' => ['required', 'min:3', 'max:255'],
        ]);

        $chirp->update($validated);

        return to_route('chirps.index')
            ->with('status', __('Chirp updated successfully!'));
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(Chirp $chirp): RedirectResponse
    {
        $this->authorize('delete', $chirp);

        $chirp->delete();

        return to_route('chirps.index')
            ->with('status', __('Chirp deleted successfully!'));
    }
}
