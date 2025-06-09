<?php

namespace App\Http\Controllers;

use App\Models\Abonne;
use App\Models\Bibliotheque;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AbonneController extends Controller
{
    public function index()
    {
        $abonnes = Abonne::latest()->paginate(10);
        return view('abonnes.index', compact('abonnes'));
    }

    public function create()
    {
        $bibliotheques = Bibliotheque::all();
        return view('abonnes.create', compact('bibliotheques'));
    }

   public function store(Request $request)
{
    $validatedData = $request->validate([
        'bibliotheque_id' => 'required|exists:bibliotheques,id',
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'adresse' => 'nullable|string',
        'contact' => 'required|string|max:20',
        'contact_urgence' => 'required|string|max:20',
        'email' => 'nullable|email|unique:abonnes,email',
        'statut' => 'required|in:ecolier,eleve,etudiant,professionnel',
        'ecole' => 'nullable|string|max:255',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // Assurez-vous que 'documents_complets' est défini correctement
    $validatedData['documents_complets'] = $request->has('documents_complets') ? true : false;
    $validatedData['compte_active'] = $validatedData['documents_complets']; // Le compte est activé uniquement si les documents sont complets

    // Gestion de la photo
    if ($request->hasFile('photo')) {
        $validatedData['photo'] = $request->file('photo')->store('photos_abonnes', 'public');
    }

    Abonne::create($validatedData);

    return redirect()->route('abonnes.index')->with('success', 'Abonné ajouté avec succès.');
}

    public function show(Abonne $abonne)
    {
        return view('abonnes.show', compact('abonne'));
    }

    public function edit(Abonne $abonne)
    {
        return view('abonnes.edit', compact('abonne'));
    }

   public function update(Request $request, Abonne $abonne)
{
    $validatedData = $request->validate([
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'adresse' => 'nullable|string',
        'contact' => 'required|string|max:20',
        'contact_urgence' => 'required|string|max:20',
        'email' => 'nullable|email|unique:abonnes,email,' . $abonne->id,
        'statut' => 'required|in:ecolier,eleve,etudiant,professionnel',
        'ecole' => 'nullable|string|max:255',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // Assurez-vous que 'documents_complets' est défini correctement
    $validatedData['documents_complets'] = $request->has('documents_complets') ? true : false;
    $validatedData['compte_active'] = $validatedData['documents_complets']; // Le compte est activé uniquement si les documents sont complets

    // Suppression de l'ancienne photo si remplacée
    if ($request->hasFile('photo')) {
        if ($abonne->photo) {
            Storage::disk('public')->delete($abonne->photo);
        }
        $validatedData['photo'] = $request->file('photo')->store('photos_abonnes', 'public');
    }

    $abonne->update($validatedData);

    return redirect()->route('abonnes.index')->with('success', 'Abonné mis à jour avec succès.');
}

    public function activerCompte($id)
    {
        $abonne = Abonne::findOrFail($id);

        if ($abonne->documents_complets) {
            $abonne->compte_active = true;
            $abonne->save();
            return redirect()->route('abonnes.index')->with('success', 'Compte activé avec succès.');
        } else {
            return redirect()->route('abonnes.index')->with('error', 'Impossible d’activer le compte sans les documents complets.');
        }
    }

    public function destroy(Abonne $abonne)
    {
        if ($abonne->photo) {
            Storage::disk('public')->delete($abonne->photo);
        }

        $abonne->delete();
        return redirect()->route('abonnes.index')->with('success', 'Abonné supprimé avec succès.');
    }

    public function activate($id)
    {
        $abonne = Abonne::findOrFail($id);

        if (!$abonne->documents_complets) {
            return response()->json(['success' => false, 'message' => 'Le dossier est incomplet.']);
        }

        $abonne->compte_active = true;
        $abonne->save();

        return response()->json(['success' => true, 'message' => 'Compte activé avec succès.']);
    }
}
