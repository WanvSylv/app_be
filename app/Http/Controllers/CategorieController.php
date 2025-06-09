<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
   // Affiche toutes les catégories
   public function index()
   {
       $categories = Categorie::all();
       return view('categories.index', compact('categories'));
   }

   // Formulaire de création
   public function create()
   {
       return view('categories.create');
   }

   // Enregistre une nouvelle catégorie
   public function store(Request $request)
   {
       $request->validate([
           'nom' => 'required|string|max:255',
           'description' => 'nullable|string',
       ]);

       Categorie::create($request->all());
       return redirect()->route('categories.index')->with('success', 'Catégorie ajoutée avec succès.');
   }

   // Affiche une catégorie spécifique
   public function show($id)
   {
       $category = Categorie::findOrFail($id);
       return view('categories.show', compact('category'));
   }

   // Formulaire de modification
   public function edit($id)
   {
       $category = Categorie::findOrFail($id);
       return view('categories.edit', compact('category'));
   }

   // Met à jour une catégorie
   public function update(Request $request, $id)
   {
       $request->validate([
           'nom' => 'required|string|max:255',
           'description' => 'nullable|string',
       ]);

       $category = Categorie::findOrFail($id);
       $category->update($request->all());
       return redirect()->route('categories.index')->with('success', 'Catégorie mise à jour avec succès.');
   }

   // Supprime une catégorie
   public function destroy($id)
   {
       $category = Categorie::findOrFail($id);
       $category->delete();
       return redirect()->route('categories.index')->with('success', 'Catégorie supprimée avec succès.');
   }
}
