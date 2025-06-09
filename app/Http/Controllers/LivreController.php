<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livre;
use App\Models\Bibliotheque;
use App\Models\Categorie;

class LivreController extends Controller
{
    public function index()
    {
        $livres = Livre::with(['bibliotheque', 'categorie'])->get();
        return view('livres.index', compact('livres'));
    }

    public function create()
    {
        $bibliotheques = Bibliotheque::all();
        $categories = Categorie::all();
        return view('livres.create', compact('bibliotheques', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bibliotheque_id' => 'required|exists:bibliotheques,id',
            'categorie_id' => 'required|exists:categories,id',
            'titre' => 'required|string|max:255',
            'auteur' => 'required|string|max:255',
            'annee_publication' => 'required|date_format:Y',
            'code_ISBN' => 'required|string|unique:livres',
            'code_barre' => 'required|string|unique:livres',
            'statut' => 'required|in:disponible,emprunté,réservé',
        ]);

        Livre::create($request->all());
        return redirect()->route('livres.index')->with('success', 'Livre créé avec succès.');
    }

    public function show($id)
    {
        $livre = Livre::findOrFail($id);
        return view('livres.show', compact('livre'));
    }

    public function edit($id)
    {
        $livre = Livre::findOrFail($id);
        $bibliotheques = Bibliotheque::all();
        $categories = Categorie::all();
        return view('livres.edit', compact('livre', 'bibliotheques', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $livre = Livre::findOrFail($id);

        $request->validate([
            'bibliotheque_id' => 'required|exists:bibliotheques,id',
            'categorie_id' => 'required|exists:categories,id',
            'titre' => 'required|string|max:255',
            'auteur' => 'required|string|max:255',
            'annee_publication' => 'required|date_format:Y',
            'code_ISBN' => "required|string|unique:livres,code_ISBN,$id",
            'code_barre' => "required|string|unique:livres,code_barre,$id",
            'statut' => 'required|in:disponible,emprunté,réservé',
        ]);

        $livre->update($request->all());
        return redirect()->route('livres.index')->with('success', 'Livre mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $livre = Livre::findOrFail($id);
        $livre->delete();
        return redirect()->route('livres.index')->with('success', 'Livre supprimé avec succès.');
    }
}
