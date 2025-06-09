<?php

namespace App\Http\Controllers;

use App\Models\Bibliotheque;
use Illuminate\Http\Request;

class BibliothequeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bibliotheques = Bibliotheque::all();
        return view('bibliotheques.index', compact('bibliotheques'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    return view('bibliotheques.create');
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'ville' => 'required|string|max:255',
            'adresse' => 'required|string',
        ]);
    
        Bibliotheque::create($validated);
        return redirect()->route('bibliotheques.index')->with('success', 'Bibliothèque ajoutée avec succès.');  
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $bibliotheque = Bibliotheque::findOrFail($id);
        return view('bibliotheques.edit', compact('bibliotheque'));
    }
 
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bibliotheque $bibliotheque)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'ville' => 'required|string|max:255',
            'adresse' => 'required|string',
        ]);
    
        $bibliotheque->update($validated);
        return redirect()->route('bibliotheques.index')->with('success', 'Bibliothèque mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bibliotheque $bibliotheque)
    {
        $bibliotheque->delete();
        return redirect()->route('bibliotheques.index')->with('success', 'Bibliothèque supprimée avec succès.');
    }
}
