<?php

namespace App\Http\Controllers;

use App\Models\Professional;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfessionalController extends Controller
{
    public function index(): View
    {
        // Graças ao Global Scope do Trait BelongsToCompany, isto já vem
        // filtrado automaticamente pela empresa do usuário logado
        $professionals = Professional::latest()->paginate(10);

        return view('professionals.index', compact('professionals'));
    }

    public function create(): View
    {
        return view('professionals.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'bio' => ['nullable', 'string'],
        ]);

        // company_id é preenchido automaticamente pelo Trait BelongsToCompany
        Professional::create($validated);

        return redirect()->route('professionals.index')
            ->with('success', 'Profissional cadastrado com sucesso.');
    }

    public function edit(Professional $professional): View
    {
        return view('professionals.edit', compact('professional'));
    }

    public function update(Request $request, Professional $professional): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'bio' => ['nullable', 'string'],
            'is_active' => ['boolean'],
        ]);

        $professional->update($validated);

        return redirect()->route('professionals.index')
            ->with('success', 'Profissional atualizado com sucesso.');
    }

    public function destroy(Professional $professional): RedirectResponse
    {
        $professional->delete();

        return redirect()->route('professionals.index')
            ->with('success', 'Profissional removido.');
    }
}